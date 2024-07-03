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
            @if ($projects->count() > 0)
            <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add Project</a>
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Location</th>
                  <th>Grade</th>
                  <th>Budget</th>
                  <th>Description</th>
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
                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i>View</a>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i> Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center p-3">
                        <h4>You don't have a project yet</h4>
                        <a href="{{ route('projects.create') }}" class="btn bg-gradient-primary">Add Project</a>
                    </div>
                </div>
            </div>
        @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
