<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{



    public function index()
    {
        $projects = Project::all();
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
            'total_budget' => 'required|numeric',
            'description' => 'required|string',
        ]);


        $project = Project::create([
            'project_name' => $request->project_name,
            'project_location' => $request->project_location,
            'project_grade' => $request->project_grade,
            'total_budget' => $request->total_budget,
            'description' => $request->description,
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
            'total_budget' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Find the existing project by ID
        $project = Project::findOrFail($id);

        // Update the project's attributes
        $project->update([
            'project_name' => $request->project_name,
            'project_location' => $request->project_location,
            'project_grade' => $request->project_grade,
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
}








// for api test

// namespace App\Http\Controllers\Projects;

// use App\Http\Controllers\Controller;
// use App\Models\Attachment;
// use App\Models\Project;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class ProjectController extends Controller
// {
//     public function index()
//     {
//         try {
//             $projects = Project::all();
//             $attachments = [];

//             // Loop through each project to retrieve its attachments
//             foreach ($projects as $project) {
//                 $projectAttachments = Attachment::where('project_id', $project->id)->get();
//                 $attachments[$project->id] = $projectAttachments;
//             }

//             return response()->json(['projects' => $projects, 'attachments' => $attachments], 200);
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Failed to retrieve projects.'], 500);
//         }
//     }


//     public function create()
//     {
//         return response()->json(['message' => 'Create method called.'], 200);
//     }

//     public function store(Request $request)
//     {
//         try {
//             $request->validate([
//                 'project_name' => 'required|string|max:255',
//                 'project_location' => 'required|string|max:255',
//                 'project_grade' => 'required|integer|between:1,5',
//                 'total_budget' => 'required|numeric',
//                 'description' => 'required|string',
//             ]);

//             $project = Project::create([
//                 'project_name' => $request->project_name,
//                 'project_location' => $request->project_location,
//                 'project_grade' => $request->project_grade,
//                 'total_budget' => $request->total_budget,
//                 'description' => $request->description,
//             ]);

//             if ($request->hasFile('attachments')) {
//                 foreach ($request->file('attachments') as $file) {
//                     $fileName = 'attachment_' . time() . '.' . $file->extension();
//                     $filePath = $file->storeAs('attachments', $fileName, 'public');
//                     Attachment::create([
//                         'project_id' => $project->id,
//                         'url' => $filePath,
//                     ]);
//                 }
//             }

//             return response()->json(['message' => 'Project created successfully.'], 200);
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Failed to create project.'], 500);
//         }
//     }

//     public function show(Project $project)
//     {
//         try {
//             $attachments = Attachment::where('project_id', $project->id)->get();
//             return response()->json(['project' => $project, 'attachments' => $attachments], 200);
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Failed to retrieve project details.'], 500);
//         }
//     }

//     public function edit(Project $project)
//     {
//         return response()->json(['message' => 'Edit method called.'], 200);
//     }

//     public function update(Request $request, $id)
//     {
//         try {
//             $request->validate([
//                 'project_name' => 'required|string|max:255',
//                 'project_location' => 'required|string|max:255',
//                 'project_grade' => 'required|integer|between:1,5',
//                 'total_budget' => 'required|numeric',
//                 'description' => 'required|string',
//             ]);

//             $project = Project::findOrFail($id);

//             $project->update([
//                 'project_name' => $request->project_name,
//                 'project_location' => $request->project_location,
//                 'project_grade' => $request->project_grade,
//                 'total_budget' => $request->total_budget,
//                 'description' => $request->description,
//             ]);

//             if ($request->hasFile('attachments')) {
//                 $oldAttachments = Attachment::where('project_id', $project->id)->get();
//                 foreach ($oldAttachments as $oldAttachment) {
//                     Storage::disk('public')->delete($oldAttachment->url);
//                     $oldAttachment->delete();
//                 }

//                 foreach ($request->file('attachments') as $file) {
//                     $fileName = 'attachment_' . time() . '.' . $file->extension();
//                     $filePath = $file->storeAs('attachments', $fileName, 'public');
//                     Attachment::create([
//                         'project_id' => $project->id,
//                         'url' => $filePath,
//                     ]);
//                 }
//             }

//             return response()->json(['message' => 'Project updated successfully.'], 200);
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Failed to update project.'], 500);
//         }
//     }

//     public function destroy(Project $project)
//     {
//         try {
//             $attachments = Attachment::where('project_id', $project->id)->get();
//             foreach ($attachments as $attachment) {
//                 Storage::disk('public')->delete($attachment->url);
//                 $attachment->delete();
//             }

//             $project->delete();

//             return response()->json(['message' => 'Project deleted successfully.'], 200);
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Failed to delete project.'], 500);
//         }
//     }
// }
