<?php

namespace App\Http\Controllers\DesignRequiremeent;

use App\Http\Controllers\Controller;
use App\Models\DesignRequirement;
use App\Models\Project;
use Illuminate\Http\Request;

class DesignRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Retrieve all projects with their attachments and the name of the user who created them
            $projects = Project::with(['requirements'])->get();

            return response()->json(['projects' => $projects], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve projects', 'message' => $e->getMessage() ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $data = $request->validate([
            'project_location' => 'required|string|max:255',
            'project_grade' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'project_type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'client_id' => 'exists:users,id',
            'project_id' => 'exists:projects,id'
        ]);

        $requirements = DesignRequirement::create($data);
        return response()->json(['message' => 'requirements created successfully', 'requirements'=> $requirements], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create requirements',  'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    try {
        // Retrieve the project with the given ID along with its requirements
        $project = Project::with(['attachments','requirements'])->findOrFail($id);

        return response()->json(['project' => $project], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to retrieve project', 'message' => $e->getMessage()], 500);
    }
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
