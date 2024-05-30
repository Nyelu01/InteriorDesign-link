@extends('designer.layouts.dashboard')
@section('title', 'Projects')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5>Projects</h5>
            <hr>
            <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add Project</a>
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Location</th>
                  <th>Grade</th>
                  <th>Budget</th>
                  <th>Description</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($projects as $project)
                <tr>
                  <td>{{ $project->project_name }}</td>
                  <td>{{ $project->project_location }}</td>
                  <td>{{ $project->project_grade }}</td>
                  <td>{{ $project->total_budget }}</td>
                  <td>{{ $project->description }}</td>
                  <td>
                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
