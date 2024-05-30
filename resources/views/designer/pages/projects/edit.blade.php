@extends('designer.layouts.dashboard')
@section('title', 'Edit Project')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12 col-lg-6">
        <div class="card">
          <div class="card-body p-3">
            <h5>Edit Project</h5>
            <hr>
            @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
            @endif
            <form method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="project_name" class="form-control-label">Project Name</label>
                    <input type="text" name="project_name" class="form-control" id="project_name" value="{{ $project->project_name }}" required>
                </div>

                <div class="form-group">
                    <label for="project_location" class="form-control-label">Project Location</label>
                    <input type="text" name="project_location" class="form-control" id="project_location" value="{{ $project->project_location }}" required>
                </div>

                <div class="form-group">
                    <label for="project_grade" class="form-control-label">Project Grade (stars)</label>
                    <select name="project_grade" class="form-control" id="project_grade" required>
                        <option value="">Select Grade</option>
                        <option value="1" {{ $project->project_grade == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $project->project_grade == 2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $project->project_grade == 3 ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $project->project_grade == 4 ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $project->project_grade == 5 ? 'selected' : '' }}>5</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="total_budget" class="form-control-label">Total Budget</label>
                    <input type="number" name="total_budget" class="form-control" id="total_budget" value="{{ $project->total_budget }}" required>
                </div>

                <div class="form-group">
                    <label for="description" class="form-control-label">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="4" required>{{ $project->description }}</textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Upload Images</label>
                    <input class="form-control" type="file" name="attachments[]" id="attachments" multiple>
                    @error('attachments')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
