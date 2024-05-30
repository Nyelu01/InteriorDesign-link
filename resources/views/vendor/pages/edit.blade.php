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
                        <div class="form-group">
                            <label for="name" class="form-control-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $product->name) }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-control-label">Image</label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control">
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <img src="{{ asset('storage/img/products/'.$product->image) }}" class="img-fluid img-thumbnail" width="150">
                        <div class="form-group">
                            <label for="description" class="form-control-label">Description</label>
                            <textarea rows="6" name="description" class="form-control" id="description">{{ old('description', $product->description) }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-control-label">Price (TZS)</label>
                            <input type="number" name="price" class="form-control" id="price" required value="{{ old('price', $product->price) }}">
                            @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="weight" class="form-control-label">Weight (kg/m<sup>3</sup>)</label>
                            <input type="number" name="weight" class="form-control" id="weight" required value="{{ old('weight', $product->weight) }}">
                            @if ($errors->has('weight'))
                                <span class="text-danger">{{ $errors->first('weight') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="form-control-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="quantity" required value="{{ old('quantity', $product->quantity) }}">
                            @if ($errors->has('quantity'))
                                <span class="text-danger">{{ $errors->first('quantity') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="width" class="form-control-label">Width (cm)</label>
                            <input type="number" name="width" class="form-control" id="width" required value="{{ old('width', $product->width) }}">
                            @if ($errors->has('width'))
                                <span class="text-danger">{{ $errors->first('width') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="height" class="form-control-label">Height (cm)</label>
                            <input type="number" name="height" class="form-control" id="height" required value="{{ old('height', $product->height) }}">
                            @if ($errors->has('height'))
                                <span class="text-danger">{{ $errors->first('height') }}</span>
                            @endif
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
