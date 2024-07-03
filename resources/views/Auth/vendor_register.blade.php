@extends('layouts.app')
@extends('layouts.navbar')
@section('title', 'Vendor Registration')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-lg-8">
                <div class="row border rounded-5 p-3 bg-white shadow box-area">

                    {{-- left box with image --}}
                    <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                        <div class="featured-image mb-3">
                            <img src="{{ asset('assets/images/vendor.png') }}" class="img-fluid" style="width: 500px; height:450px">
                        </div>
                        <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">
                            Be Verified</p>
                        <small class="text-white text-wrap text-center"
                            style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers
                            on this platform.</small>
                    </div>
                    {{-- right box --}}
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header">
                                <h2 class="fw-bold text-secondary">Register</h2>
                            </div>
                            <div class="card-body p-5">
                                <form action="{{ route('vendor.register') }}" method="post" enctype="multipart/form-data">
                                      @csrf
                                      @method('post')
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
                                        <input type="hidden" name="role" value="1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="business_licence" class="form-label">Upload business licence</label>
                                        <input type="file" name="business_licence" id="business_licence"
                                            class="form-control rounded-0 @error('business-licence') is-invalid @enderror">
                                        @error('business_licence')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 d-grid">
                                        <input type="submit" value="Register" class="btn btn-secondary rounded-0">
                                    </div>
                                    <div class="text-center text-secondary">
                                        <div>Already have an account? <a href="{{route('auth.login')}}" class="text-decoration-none">Login
                                                Here</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
