

@extends('frontend.main_f.success')

@section('title')
    Success Page
@endsection

@section('content')
<div class="page-content page-success">
    <div class="section-success" data-aos="zoom-in">
      <div class="container">
        <div class="row align-items-center row-login justify-content-center">
          <div class="col-lg-6 text-center">
            <img src="/images/bag.png" alt="" class="mb-4" />
            <h2>Transaction Processed!</h2>
            <p>
              Kamu sudah berhasil terdaftar bersama kami. Let’s grow up now.
            </p>
            <div>
              <a href="/dashboard.html" class="btn btn-success w-50 mt-4">
                MyDashboard
              </a>
              <a href="/index.html" class="btn btn-signup w-50 mt-3">
                GoTo Shopping
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection