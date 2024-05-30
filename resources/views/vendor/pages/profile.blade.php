@extends('vendor.layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="fw-bold text-secondary">Edit profile</h2>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('vendor.register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" id="name"
                            class="form-control rounded-0 @error('name') is-invalid @enderror"
                            placeholder="Full Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" id="email"
                            class="form-control rounded-0 @error('email') is-invalid @enderror"
                            placeholder="E-mail">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="text" name="phone" id="phone"
                            class="form-control rounded-0 @error('phone') is-invalid @enderror"
                            placeholder="Phone Number">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" id="password"
                            class="form-control rounded-0 @error('password') is-invalid @enderror"
                            placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" name="cpassword" id="cpassword"
                            class="form-control rounded-0 @error('cpassword') is-invalid @enderror"
                            placeholder="Confirm Password">
                        @error('cpassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select name="location" id="location"
                            class="form-select rounded-0 @error('location') is-invalid @enderror">
                            <option value="" selected disabled>Select office location</option>
                            <option value="Arusha">Arusha</option>
                            <option value="Dar es Salaam">Dar es Salaam</option>
                            <option value="Dodoma">Dodoma</option>
                            <option value="Geita">Geita</option>
                            <option value="Iringa">Iringa</option>
                            <option value="Kagera">Kagera</option>
                            <option value="Katavi">Katavi</option>
                            <option value="Kigoma">Kigoma</option>
                            <option value="Kilimanjaro">Kilimanjaro</option>
                            <option value="Lindi">Lindi</option>
                            <option value="Manyara">Manyara</option>
                            <option value="Mara">Mara</option>
                            <option value="Mbeya">Mbeya</option>
                            <option value="Morogoro">Morogoro</option>
                            <option value="Mtwara">Mtwara</option>
                            <option value="Mwanza">Mwanza</option>
                            <option value="Njombe">Njombe</option>
                            <option value="Pwani">Pwani</option>
                            <option value="Rukwa">Rukwa</option>
                            <option value="Ruvuma">Ruvuma</option>
                            <option value="Shinyanga">Shinyanga</option>
                            <option value="Simiyu">Simiyu</option>
                            <option value="Singida">Singida</option>
                            <option value="Tabora">Tabora</option>
                            <option value="Tanga">Tanga</option>
                        </select>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="business-licence" class="form-label">Upload business licence</label>
                        <input type="file" name="business-licence" id="business-licence" accept="image/*" class="form-control rounded-0 @error('business-licence') is-invalid @enderror">
                        @error('business-licence')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                      {{-- <img src="{{ asset('storage/images/'.$compaign->cover_image) }}" class="img-fluid img-thumbnail" width="150"> --}}

                    <div class="mb-5 d-grid">
                        <input type="submit" value="Update profile" class="btn btn-primary rounded-0">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- /.content -->
@endsection




