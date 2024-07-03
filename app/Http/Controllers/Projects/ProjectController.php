<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        try {
            // Retrieve all projects with their attachments and the name of the user who created them
            $projects = Project::with(['attachments', 'user:id,name', 'requirements'])->get();

            return response()->json(['projects' => $projects], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve projects', 'message' => $e->getMessage()], 500);
        }
    }




    public function store(Request $request)
    {
        try {
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
                    $fileName = 'attachment_' . time() . '.' . $file->extension();
                    $filePath = $file->storeAs('attachments', $fileName, 'public');
                    Attachment::create([
                        'project_id' => $project->id,
                        'url' => $filePath,
                    ]);
                }
            }

            return response()->json(['message' => 'Project created successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create project', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Project $project)
    {
        try {
            // Eager load the attachments and user relationships
            $project->load(['attachments', 'user:id,name']);

            return response()->json(['project' => $project], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve project details', 'message' => $e->getMessage()], 500);
        }
    }



    public function update(Request $request, $id)
    {
        try {
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

            if ($request->hasFile('attachments')) {
                $oldAttachments = Attachment::where('project_id', $project->id)->get();
                foreach ($oldAttachments as $oldAttachment) {
                    Storage::disk('public')->delete($oldAttachment->url);
                    $oldAttachment->delete();
                }

                foreach ($request->file('attachments') as $file) {
                    $fileName = 'attachment_' . time() . '.' . $file->extension();
                    $filePath = $file->storeAs('attachments', $fileName, 'public');
                    Attachment::create([
                        'project_id' => $project->id,
                        'url' => $filePath,
                    ]);
                }
            }

            return response()->json(['message' => 'Project updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update project', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Project $project)
    {
        try {
            $attachments = Attachment::where('project_id', $project->id)->get();
            foreach ($attachments as $attachment) {
                Storage::disk('public')->delete($attachment->url);
                $attachment->delete();
            }

            $project->delete();

            return response()->json(['message' => 'Project deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete project', 'message' => $e->getMessage()], 500);
        }
    }
}
