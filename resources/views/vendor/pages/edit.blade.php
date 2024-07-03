@extends('vendor.layouts.dashboard')
@section('title', 'Edit Product')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body p-3">
                    <h5>Edit Product</h5>
                    <hr>
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $product->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Image</label>
                                    <input type="file" name="image" id="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('storage/img/products/' . $product->image) }}" class="img-fluid img-thumbnail" width="150">
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-control-label">Description</label>
                            <textarea rows="6" name="description" class="form-control @error('description') is-invalid @enderror" id="description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Price (TZS)</label>
                                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" required value="{{ old('price', $product->price) }}">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight" class="form-control-label">Weight (kg/m<sup>3</sup>)</label>
                                    <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight" required value="{{ old('weight', $product->weight) }}">
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity" class="form-control-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity" required value="{{ old('quantity', $product->quantity) }}">
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="width" class="form-control-label">Width (cm)</label>
                                    <input type="number" name="width" class="form-control @error('width') is-invalid @enderror" id="width" required value="{{ old('width', $product->width) }}">
                                    @error('width')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="height" class="form-control-label">Height (cm)</label>
                                    <input type="number" name="height" class="form-control @error('height') is-invalid @enderror" id="height" required value="{{ old('height', $product->height) }}">
                                    @error('height')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">Edit Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
