@extends('designer.layouts.dashboard')
@section('title', 'Create Item')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body p-3">
                    <h5>Add Item</h5>
                    <hr>
                    <form method="POST" action="{{ route('items.store') }}">
                        @csrf
                        <input type="hidden" name="requirement_id" value="{{ $requirement_id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Item name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="quantity" class="form-control-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity" value="{{ old('quantity') }}" required>
                                    @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type" class="form-control-label">Type</label>
                                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select Type</option>
                                        <option value="design material" {{ old('type') == 'design material' ? 'selected' : '' }}>Design material</option>
                                        <option value="worker" {{ old('type') == 'worker' ? 'selected' : '' }}>Worker</option>
                                        <option value="personal" {{ old('type') == 'personal' ? 'selected' : '' }}>Personal</option>
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit_price" class="form-control-label">Unit price</label>
                                    <input type="number" step="0.01" name="unit_price" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" value="{{ old('unit_price') }}" required>
                                    @error('unit_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="total_price" class="form-control-label">Total price</label>
                                    <input type="number" step="0.01" name="total_price" class="form-control @error('total_price') is-invalid @enderror" id="total_price" value="{{ old('total_price') }}" readonly>
                                    @error('total_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-control-label">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('designer.pages.BudgetItem.items')

    <div class="row mt-4">
        <div class="col-12">
            <form method="GET" action="{{ route('generate.pdf') }}" target="_blank">
                <input type="hidden" name="requirement_id" value="{{ $requirement_id }}">
                <button type="submit" class="btn btn-primary">Generate Budget</button>
            </form>
        </div>
    </div>

</div>
@endsection
