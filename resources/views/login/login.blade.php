

@extends('frontend.main_f.auth')

@section('title')
    Login Page
@endsection

@section('content')
<div class="page-content page-auth">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-content-center row-login">
          <div class="col-lg-6 text-center">
            <img
              src="/images/login-page.png"
              class="w-50 mb-4 mb-lg-none"
              alt=""
            />
          </div>
          <div class="col-lg-5">
            <h2>
              Belanja Kebutuhan Utama <br />
              Menjadi Lebih Muda
            </h2>

            @if(session()->has('success'))
                      <div class=" col-lg-10 alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ session('success'); }}
                      </div>
              @endif

            @if(session()->has('loginerror'))
                      <div class=" col-lg-10 alert alert-danger alert-dismissible fade show text-center" role="alert">
                        {{ session('loginerror'); }}
                      </div>
              @endif

            <form action="{{ route('authtifikasi') }}" class="mt-3" method="POST">
                @csrf
                  <div class="form-group">
                    <label> Email Addres</label>
                    <input type="text" name="email" value="{{ old('email') }}" autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror w-75" />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>


                  <div class="form-group">
                    <label> Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" autocomplete="password" autofocus class="form-control @error('password') is-invalid @enderror w-75"  />
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                  <button
                    type="submit"
                    class="btn btn-success btn-block w-75 mt-3"
                  >
                    Sign In To MyAccount
                  </button>
                  
                  <a
                    href="{{ route('register') }}"
                    class="btn btn-signup btn-block w-75 mt-2"
                  >
                    Sign Up
                  </a>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
 
@endsection

@push('addon-script')
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 5000);
</script>

@endpush

