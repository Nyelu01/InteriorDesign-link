@extends('designer.layouts.dashboard')
@section('title', 'Project Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Project Details:</h5>
                    <hr>
                    @if($project)
                        <p><strong>Project Name:</strong> {{ $project->project_name }}</p>
                        <p><strong>Project Location:</strong> {{ $project->project_location }}</p>
                        <p><strong>Service type:</strong> {{ $project->service_type }}</p>
                        <p><strong>Project Location:</strong> {{ $project->project_location }}</p>
                        <p><strong>Project Grade:</strong> {{ $project->project_grade }}</p>
                        <p><strong>Total Budget:</strong> {{ $project->total_budget }}</p>
                        <p><strong>Description:</strong> {{ $project->description }}</p>

                        <h6 class="mt-4">Attachments:</h6>
                        @if($attachments->isNotEmpty())
                            <div class="row">
                                @foreach($attachments as $attachment)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset('storage/' . $attachment->url) }}" class="img-fluid" alt="Attachment">
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p>No attachments found.</p>
                        @endif
                    @else
                        <p>Project not found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
