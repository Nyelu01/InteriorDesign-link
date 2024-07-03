<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Budget;
use App\Models\BudgetItem;
use App\Models\DesignRequirement;
use App\Models\Product;
use App\Models\Project;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DesignerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $projects = Project::where('user_id', Auth::user()->id)->get();
        return view('designer.pages.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('designer.pages.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_location' => 'required|string|max:255',
            'project_grade' => 'required|integer|between:1,5',
            'service_type' => 'required|string|max:255',
            'project_type' => 'required|string|max:255',
            'total_budget' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $project = Project::create([
            'project_name' => $request->project_name,
            'project_location' => $request->project_location,
            'project_grade' => $request->project_grade,
            'service_type' => $request->service_type,
            'project_type' => $request->project_type,
            'total_budget' => $request->total_budget,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $fileName = 'attachment_' . time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('attachments', $fileName, 'public');
                Attachment::create([
                    'project_id' => $project->id,
                    'url' => $filePath,
                ]);
            }
        }


        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }


    public function show(Project $project)
    {
        // Fetch attachments associated with the project
        $attachments = Attachment::where('project_id', $project->id)->get();

        // Pass the project and its attachments to the view
        return view('designer.pages.projects.show', compact('project', 'attachments'));
    }



    public function edit(Project $project)
    {
        return view('designer.pages.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_location' => 'required|string|max:255',
            'project_grade' => 'required|integer|between:1,5',
            'service_type' => 'required|string|max:255',
            'project_type' => 'required|string|max:255',
            'total_budget' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'project_name' => $request->project_name,
            'project_location' => $request->project_location,
            'project_grade' => $request->project_grade,
            'service_type' => $request->service_type,
            'project_type' => $request->project_type,
            'total_budget' => $request->total_budget,
            'description' => $request->description,
        ]);
        // Check if there are any attachments to handle
        if ($request->hasFile('attachments')) {
            // Delete old attachments from storage and database
            $oldAttachments = Attachment::where('project_id', $project->id)->get();
            foreach ($oldAttachments as $oldAttachment) {
                // Delete the file from the storage
                Storage::disk('public')->delete($oldAttachment->url);

                // Delete the attachment record from the database
                $oldAttachment->delete();
            }

            // Save new attachments with custom filenames
            foreach ($request->file('attachments') as $file) {
                $fileName = 'attachment_' . time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('attachments', $fileName, 'public');
                Attachment::create([
                    'project_id' => $project->id,
                    'url' => $filePath,
                ]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }



    public function destroy(Project $project)
    {
        // Retrieve and delete the project's attachments
        $attachments = Attachment::where('project_id', $project->id)->get();
        foreach ($attachments as $attachment) {
            // Delete the file from the storage
            Storage::disk('public')->delete($attachment->url);

            // Delete the attachment record from the database
            $attachment->delete();
        }

        // Delete the project
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function viewMaterials()
    {
        $products = Product::get();
        return view('designer.pages.products', compact('products'));
    }

    public function client_requirements(Request $request)
    {
        try {
            // Retrieve requirements details along with project name
            $requirements = DesignRequirement::with('project', 'client')->get();

            // Example to set the first requirement's id into session (modify as needed)
            if ($requirements->isNotEmpty()) {
                $requirement_id = $requirements->first()->id;
                $request->session()->put('requirement_id', $requirement_id);
            }

            return view('designer.pages.Requirements.requirements', compact('requirements'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve requirements', 'message' => $e->getMessage()], 500);
        }
    }
    public function generateBudget(Request $request)
    {
        try {
            // Retrieve requirement_id from the request parameters
            $requirement_id = $request->get('requirement_id');

            // Retrieve budget items for the authenticated designer and specific requirement
            $items = BudgetItem::with('designer', 'requirement.client') // Ensure requirement and client are eager loaded
                ->where('designer_id', Auth::id())
                ->where('requirement_id', $requirement_id)
                ->get();

            // Calculate total budget for the specific requirement
            $totalBudget = $items->sum('total_price');

            // Generate the HTML for the PDF
            $html = view('designer.pages.BudgetItem.items', compact('items', 'totalBudget'))->render();

            // PDF options
            $pdfOptions = new Options();
            $pdfOptions->set('defaultFont', 'Arial');

            // Instantiate Dompdf with the options
            $dompdf = new Dompdf($pdfOptions);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            // Generate a filename for the PDF
            $filename = 'budget_report_' . Auth::id() . '_' . time() . '.pdf';

            // Save the PDF to storage
            $pdfOutput = $dompdf->output();
            Storage::put('public/budgets/' . $filename, $pdfOutput);

            // Save the PDF path in the database
            $budget = new Budget();
            $budget->designer_id = Auth::id();
            $budget->requirement_id = $requirement_id;
            $budget->pdf_path = 'public/budgets/' . $filename;
            $budget->save();

            // Redirect to the budget list view
            return redirect()->route('designer.budgetList')->with('success', 'Budget PDF generated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate budget PDF: ' . $e->getMessage());
        }
    }





    public function budgetList()
    {
        try {
            $pdfs = Budget::where('designer_id', Auth::id())->get();

            return view('designer.pages.BudgetList.budget_list', compact('pdfs'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to retrieve PDF list: ' . $e->getMessage());
        }
    }

    public function deleteBudget($id)
    {
        try {
            $budget = Budget::where('designer_id', Auth::id())->findOrFail($id);

            // Delete the PDF from storage
            Storage::disk('public')->delete($budget->pdf_path);

            // Delete the budget record from the database
            $budget->delete();

            return redirect()->route('designer.budgetList')->with('success', 'Budget PDF deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete budget PDF: ', ['error' => $e->getMessage()]);
            return redirect()->route('designer.budgetList')->with('error', 'Failed to delete budget PDF: ' . $e->getMessage());
        }
    }
}
