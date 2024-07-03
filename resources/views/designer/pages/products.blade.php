@extends('designer.layouts.dashboard')
@section('title', 'Design materials')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Interior design materials</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">design materials</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <div class="col-xl-3 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <img src="{{ asset('storage/img/products/' . $product->image) }}" alt="{{ $product->name }}"
                                style="height: 150px; width: 100%; object-fit: contain;">
                            </div>
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                                {{ $product->name }}
                                            </p>
                                            <h5 class="font-weight-bolder mb-0">
                                                {{ number_format($product->price, 0, ',', ',') }} Tsh
                                            </h5>
                                            <small>{{ Str::limit($product->description, 50) }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <h6><b>quantity:</b> {{$product->quantity}}</h6>
                                <h5></h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center p-3">
                            <h4>No materials posted</h4>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
