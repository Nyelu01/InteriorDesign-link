@extends('designer.layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('designer.update') }}"enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <select id="location" class="form-select" name="location" required>
                                    <option value="Arusha" {{ $user->location === 'Arusha' ? 'selected' : '' }}>Arusha</option>
                                    <option value="Dar es Salaam" {{ $user->location === 'Dar es Salaam' ? 'selected' : '' }}>Dar es Salaam</option>
                                </select>
                            </div> --}}

                            <!-- Add more fields as needed -->

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
