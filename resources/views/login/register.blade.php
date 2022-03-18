

@extends('frontend.main_f.auth')

@section('title')
    Register Page
@endsection

@section('content')
<div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div
          class="row align-content-center justify-content-center row-login"
        >
          <div class="col-lg-4">
            <h2>
              Memulai untuk jual beli<br />
              Dengan Cara Terbaru
            </h2>
            
            <form action="{{ route('register-success') }}" method="POST" class="mt-3">
              @csrf
                  <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                            autocomplete="name" 
                            autofocus 
                            id="name"
                            v-model ="name"
                            class="form-control @error('name') is-invalid @enderror w-75" />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                  <div class="form-group">
                    <label> Email Addres</label>
                    <input type="text" name="email" value="{{ old('email') }}" 
                            autocomplete="email" 
                            autofocus 
                            id="email"
                            v-model ="email"
                            @change="checkForEmail()"
                            :class="{ 
                              'is-invalid' : this.email_unavailable
                             }"
                            class="form-control @error('email') is-invalid @enderror w-75" />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                  <div class="form-group">
                    <label> Password</label>
                    <input id="password" type="password" name="password"
                            autocomplete="new-password" 
                            autofocus 
                            class="form-control @error('password') is-invalid @enderror w-75" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                  <div class="form-group">
                    <label> Konfirmasi Password</label>
                    <input id="password_confirm" type="password" 
                            autocomplete="new-password" 
                            autofocus 
                            name="password_confirmation"
                            required
                            class="form-control @error('password_confirmation') is-invalid @enderror w-75" />
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div> 

                  <div class="form-group">
                    <label>Store</label>
                    <p class="text-muted">Apakah anda ingin membuka toko</p>

                    <div
                      class="custom-control custom-radio custom-control-inline"
                    >
                      <input
                        type="radio"
                        class="custom-control-input"
                        name="is_store_open"
                        id="openStoreTrue"
                        v-model="is_store_open"
                        :value="true"
                      />
                      <label for="openStoreTrue" class="custom-control-label">
                        Iya,Boleh
                      </label>
                    </div>

                    <div
                      class="custom-control custom-radio custom-control-inline"
                    >
                      <input
                        type="radio"
                        class="custom-control-input"
                        name="is_store_open"
                        id="openStoreFalse"
                        v-model="is_store_open"
                        :value="false"
                      />
                      <label for="openStoreFalse" class="custom-control-label">
                        Tidak, Terimakasih
                      </label>
                    </div>
                  </div>

                  <div class="form-group" v-if="is_store_open">
                    <label>Nama Toko</label>
                    <input id="text" type="text" name="store_name" value="{{ old('store_name') }}" 
                            autocomplete="store_name" 
                            autofocus 
                            v-model ="store_name"
                            class="form-control @error('store_name') is-invalid @enderror w-75" />
                        @error('store_name')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                  <div class="form-group" v-if="is_store_open">
                    <label>Kategori</label>
                    <select name="categories_id" class="form-control">
                      <option value="">Select Category</option>

                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <button
                    type="submit"
                    class="btn btn-success btn-block mt-3"
                    :disabled="this.email_unavailable"
                  >
                    Sign Up Now
                  </button>

                  <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                    Back To SignIn
                  </a>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
  Vue.use(Toasted);

  var register = new Vue({
    el: "#register",
    mounted() {
      AOS.init();
    },
    methods:{
      checkForEmail: function(){
        //menempelkan varibel this di dalam self, alasan pindahin dulu varibel this didalam self biar bisa 
        //dipakai axios nya

        var self = this;
        axios.get('{{ route('api-register-check') }}', {
          params : {
            email: this.email
          }
        })
            .then(function (response) {
              if(response.data == 'Available'){
                self.$toasted.show("Email bisa dipakai", {
                  position: "top-center",
                  className: "rounded",
                  duration: 5000,
                });
                self.email_unavailable = false;

              }else{
                self.$toasted.error("Maaf, Email Sudah Terdaftar Disistem Kami", {
                  position: "top-center",
                  className: "rounded",
                  duration: 5000,
                });

                self.email_unavailable = true;
              }

              // handle success
              console.log(response);
            });
      }
    },
    data(){
      return {
        email_unavailable : false
      }
    },
  });
</script>
@endpush