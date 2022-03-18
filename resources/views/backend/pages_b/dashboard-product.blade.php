@extends('backend.main_b.dashboard')

@section('title')
    Store Dashboard Product
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">My Product</h2>
        <p class="dashboard-subtitle"> Look what you made today!</p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-12">
            <a href="{{ route('dashboard-product-create') }}l" class="btn btn-success">
              Add New Product
            </a>
          </div>
        </div>  
      
        <div class="row mt-4">

          @foreach ($product as $data)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
              <a href="{{ route('dashboard-product-detail', $data->id) }}" class="card card-dahsboard-product d-block">
                <div class="card-body">
                  <img src="{{ Storage::url($data->gallaries->first()->photos ?? '') }}" alt="" class="w-100 mb-2">
                  <div class="product-title">
                    {{ $data->name }}
                  </div>
                  <div class="product-category">
                    {{ $data->category->name }}
                  </div>
                </div>
              </a>
            </div>
              
          @endforeach

        </div>

      </div>
    </div>
</div>
@endsection