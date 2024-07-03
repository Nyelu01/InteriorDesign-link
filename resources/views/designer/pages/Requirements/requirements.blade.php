@extends('designer.layouts.dashboard')
@section('title', 'Requirements')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Requirements from clients</h5>
                        <hr>
                        @if ($requirements->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Location</th>
                                        <th>Grade</th>
                                        <th>Service Type</th>
                                        <th>Project Type</th>
                                        <th>Description</th>
                                        <th>Client Name</th>
                                        <th>Client Phone</th>
                                        <th>Reviewed Project</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requirements as $requirement)
                                        <tr>
                                            <td>{{ $requirement->project_location }}</td>
                                            <td>{{ $requirement->project_grade }}</td>
                                            <td>{{ $requirement->service_type }}</td>
                                            <td>{{ $requirement->project_type }}</td>
                                            <td>{{ $requirement->description }}</td>
                                            <td>{{ $requirement->client->name }}</td>
                                            <td>{{ $requirement->client->phone }}</td>
                                            <td>{{ $requirement->project->project_name }}</td>
                                            <td><a href = "{{ route('items.index', ['requirement_id' => $requirement->id]) }}" class="btn btn-primary">Create Budget</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center p-3">
                                        <h4>No requirements found</h4>
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
