@extends('designer.layouts.dashboard')
@section('title', 'Create Project')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12 col-lg-6">
        <div class="card">
          <div class="card-body p-3">
            <h5>Create Project</h5>
            <hr>
            @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
            @endif
            <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="project_name" class="form-control-label">Project Name</label>
                            <input type="text" name="project_name" class="form-control" id="project_name" value="{{ old('project_name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="project_location" class="form-control-label">Project Location</label>
                            <input type="text" name="project_location" class="form-control" id="project_location" value="{{ old('project_location') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="project_grade" class="form-control-label">Project Grade (stars)</label>
                            <select name="project_grade" class="form-control" id="project_grade" required>
                                <option value="">Select Grade</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-control-label">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="4" required>{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="service_type" class="form-control-label">Service Type</label>
                            <select name="service_type" id="service_type" class="form-control @error('service_type') is-invalid @enderror" required>
                                <option value="" disabled>Select Service Type</option>
                                <option value="interior furnishing">Interior Furnishing</option>
                                <option value="interior decoration">Interior Decoration Design</option>
                                <!-- Add more options as needed -->
                            </select>
                            @error('service_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="project_type" class="form-control-label">Project type</label>
                            <select name="project_type" id="project_type" class="form-control @error('project_type') is-invalid @enderror" required>
                                <option value="" selected disabled>Select Project Type</option>
                                <option value="Residential">Residential</option>
                                <option value="Workplace">Workplace</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Industrial">Industrial</option>
                            </select>
                            @error('project_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="total_budget" class="form-control-label">Total Budget</label>
                            <input type="text" name="total_budget" class="form-control" id="total_budget" value="{{ old('total_budget') }}" required>
                        </div>
                    </div>
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
                    <button class="btn btn-primary">Create</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
