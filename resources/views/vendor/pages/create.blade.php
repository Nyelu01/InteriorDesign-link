@extends('vendor.layouts.dashboard')
@section('title', 'Add product')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body p-3">
            <h5>Add Product</h5>
            <hr>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name" class="form-control-label">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="image" class="form-control-label">Image</label>
                    <input type="file" name="image" class="form-control form-control-file @error('image') is-invalid @enderror" id="image" accept=".jpg, .png, .svg" required>
                    @error('image')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="price" class="form-control-label">Price (tzs)</label>
                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" value="{{ old('price') }}" required>
                    @error('price')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="weight" class="form-control-label">Weight (kg/m<sup>3</sup>)</label>
                    <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight" value="{{ old('weight') }}" required>
                    @error('weight')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="quantity" class="form-control-label">Quantity</label>
                    <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity" value="{{ old('quantity') }}" required>
                    @error('quantity')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description" class="form-control-label">Description</label>
                    <textarea rows="6" name="description" class="form-control @error('description') is-invalid @enderror" id="description" required>{{ old('description') }}</textarea>
                    @error('description')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="width" class="form-control-label">Width (cm)</label>
                    <input type="text" name="width" class="form-control @error('width') is-invalid @enderror" id="width" value="{{ old('width') }}" required>
                    @error('width')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="height" class="form-control-label">Height (cm)</label>
                    <input type="text" name="height" class="form-control @error('height') is-invalid @enderror" id="height" value="{{ old('height') }}" required>
                    @error('height')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary">Add</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
