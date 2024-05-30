@extends('vendor.layouts.dashboard')
@section('title', 'products')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   <!-- Main content -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-around">
                    <p class="mb-0">Sort By</p>
                    <select class="form-control w-75" id="sortBy">
                        <option value="" {{ request()->sort == '' ? 'selected' : '' }}>Latest</option>
                        <option value="asc" {{ request()->sort == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request()->sort == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
            </div>
            <div class="col-md-8 text-end">
                <div class="form-inline justify-content-end">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @if($products->count() > 0)
                @foreach($products as $product)
                <div class="col-xl-3 col-sm- mb-4">
                    <div class="card">
                        <div class="card-header text-center">
                            <img src="{{ asset('assets/img') }}/{{ $product->image }}" style="height: 150px; width: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <small class="d-flex align-items-center text-capitalize">
                                            <i class="ri-store-2-fill me-1"></i>
                                            <span>{{ $product->seller->name }}</span>
                                        </small>
                                        <p class="mb-0 text-capitalize font-weight-bold">{{ $product->name }}</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            ${{ number_format($product->price, 0, '.', '.') }}
                                        </h5>
                                        <small>{{ $product->description }}</small>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    @if(!$product->sold)
                                    <a href="{{ route('product.buy', $product->id) }}" class="btn bg-gradient-primary">Buy</a>
                                    @else
                                    <span class="btn bg-gradient-danger">Sold</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center p-3">
                            <h4>Product Not Available</h4>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>


  <script>
    const sortBy = document.getElementById('sortBy')
    sortBy.addEventListener('change', function() {
      const sort = 'sort=' + this.value + ''
      let url = "{{ route('product.index', ':sort') }}"
      url = url.replace(':sort', sort)
      window.location.href = url
    })
  </script>
    </section>
    <!-- /.content -->
@endsection
