@extends('backend.main_b.dashboard')

@section('title')
    Dashboard Page
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Dashboard</h2>
        <p class="dashboard-subtitle"> Look what you made today!</p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-md-4">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">
                  Customer
                </div>
                <div class="dashboard-card-subtitle">
                  15,890
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">
                  Revenue
                </div>
                <div class="dashboard-card-subtitle">
                  15,890
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">
                  Transaction
                </div>
                <div class="dashboard-card-subtitle">
                  15,890
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-12 mt-2">
            <h5 class="mb-3">
              Recent Transaction
            </h5>
            <a href="/dashboard-transactions-detail.html" class="card card-list d-block">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-1">
                    <img src="/images/dashboard-icon.png" alt="">
                  </div>
                  <div class="col-md-4">
                    Shirup Mezan
                  </div>
                  <div class="col-md-3">
                    Meyzan Al Yutra
                  </div>
                  <div class="col-md-3">
                    12 Januari,20
                  </div>
                  <div class="col-md-1 d-md-block d-none">
                    <img src="/images/dashboard-panah.svg" alt="">
                  </div>
                </div>
              </div>
            </a>

            <a href="/dashboard-transactions-detail.html" class="card card-list d-block">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-1">
                    <img src="/images/dashboard-icon.png" alt="">
                  </div>
                  <div class="col-md-4">
                    Shirup Mezan
                  </div>
                  <div class="col-md-3">
                    Meyzan Al Yutra
                  </div>
                  <div class="col-md-3">
                    12 Januari,20
                  </div>
                  <div class="col-md-1 d-md-block d-none">
                    <img src="/images/dashboard-panah.svg" alt="">
                  </div>
                </div>
              </div>
            </a>

            <a href="/dashboard-transactions-detail.html" class="card card-list d-block">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-1">
                    <img src="/images/dashboard-icon.png" alt="">
                  </div>
                  <div class="col-md-4">
                    Shirup Mezan
                  </div>
                  <div class="col-md-3">
                    Meyzan Al Yutra
                  </div>
                  <div class="col-md-3">
                    12 Januari,20
                  </div>
                  <div class="col-md-1 d-md-block d-none">
                    <img src="/images/dashboard-panah.svg" alt="">
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection