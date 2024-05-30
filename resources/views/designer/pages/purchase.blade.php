@extends('vendor.layouts.dashboard')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body p-3">
            @if(Auth::check() && Auth::user()->purchases->count() > 0)
            <h5>Purchase History</h5>
            <hr>
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product name</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Seller</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quantity</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Weight</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">dimension</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                </tr>
              </thead>
              <tbody>
                  @foreach(Auth::user()->purchases as $product)
                    <tr>
                      <td>
                        <h6 class="mb-0 text-sm">{{ $product->detail->name }}</h6>
                      </td>
                      <td>
                        <img src="{{ asset('assets/img/products') }}/{{ $product->detail->image }}" style="height: 90px; width: 90px; object-fit: contain"/>
                      </td>
                      <td>
                        <div class="d-flex">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $product->detail->seller->name }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $product->detail->seller->phone }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <h6 class="mb-0 text-sm">{{ number_format($product->detail->price, 0, ',', ',') }}Tsh</h6>
                      </td>
                      <td>
                        <h6 class="mb-0 text-sm">{{ $product->detail->description }}</h6>
                      </td>
                      <td>
                        {{ $product->created_at }}
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
