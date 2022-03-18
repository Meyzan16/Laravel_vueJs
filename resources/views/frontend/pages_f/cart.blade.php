

@extends('frontend.main_f.app')

@section('title')
    Store Cart Page
@endsection

@section('content')
<div class="page-content page-cart">
    <!-- breadcrumbs -->
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="/index.html"> Home </a>
                </li>
                <li class="breadcrumb-item active">
                  Card
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section class="store-cart">
      <div class="container">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-12 table-responsive">
            <table class="table table-borderless table-cart">
              <thead>
                <tr>
                  <td>Image</td>
                  <td>Name &amp; Seller</td>
                  <td>Price</td>
                  <td>Menu</td>
                </tr>
              </thead>
              <tbody>
                @php
                    $total_price = 0 ;
                @endphp
              @foreach ($carts as $item)    
                <tr>
                  <td style="width: 20%;">
                    @if ($item->product->gallaries)
                    <img src="{{ Storage::url($item->product->gallaries->first()->photos) }}" alt="" class="cart-image" >
                    @endif
                  </td>
                  <td style="width: 35%;">
                    <div class="product-title">{{ $item->product->name }}</div>
                    <div class="product-subtitle">{{ $item->product->user->store_name }}</div>
                  </td>
                  <td style="width: 35%;">
                    <div class="product-title">{{ number_format($item->product->price) }} </div>
                    <div class="product-subtitle">USD</div>
                  </td>
                  <td style="width: 20%;">
                    <form action="{{ route('cart-delete', $item->id) }}" method="POST" >
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-remove-cart">
                        Remove
                      </button>
                    </form>

                  </td>
                </tr>

                  @php
                      $total_price += $item->product->price;
                  @endphp
              @endforeach
              
              </tbody>
            </table>
          </div>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="150">
          <div class="col-12">
            <hr>
          </div>
          <div class="col-12">
            <h2 class="mb-4"> Shipping Details</h2>
          </div>
        </div>

        <form action="{{ route('checkout') }}" id="locations" enctype="multipart/form-data" method="POST">
          @csrf 
          <input type="hidden" name="total_price" value="{{ $total_price }}">

          <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
            <div class="col-md-6">
              <div class="form-group">
                <label for="address_one"> Address 1</label>
                <input type="text" class="input form-control" id="address_one" name="address_one" value="Setra Duta"></input>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="address_two"> Address 2</label>
                <input type="text" class="input form-control" id="address_two" name="address_two" value="BLOK 2 JKR"></input>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="provinces_id"> Province </label>
                <select name="provinsi_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id">
                  <option v-for="province in provinces" :value="province.id" >
                      @{{ province.name }}
                  </option>
                </select>

                <select v-else class="form-control"></select>

              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="kabupaten_id"> City </label>
                <select name="kabupaten_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                  <option v-for="regency in regencies" :value="regency.id" >
                      @{{ regency.name }}
                  </option>
                </select>

                <select v-else class="form-control"></select>
                
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="zip_code">Postal Code</label>
                <input type="text" class="input form-control" id="zip_code" name="zip_code" value="40152"></input>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="kota">Country</label>
                <input type="text" class="input form-control" id="kota" name="negara" value="Indonesia"></input>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone_number">Mobile </label>
                <input type="text" class="input form-control" id="phone_number" name="phone_number" value="+628 2020 11111"></input>
              </div>
            </div>          
          </div>

          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr>
            </div>
            <div class="col-12">
              <h2 class="mb-1"> Payment Informations</h2>
            </div>

          </div>

          <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col-4 col-md-2">
              <div class="product-title">$0</div>
              <div class="product-subtitle">Country Text</div>
            </div>
            <div class="col-4 col-md-3">
              <div class="product-title">$0</div>
              <div class="product-subtitle">Country Text</div>
            </div>
            <div class="col-4 col-md-2">
              <div class="product-title">$0</div>
              <div class="product-subtitle">Country Text</div>
            </div>
            <div class="col-4 col-md-2">
              <div class="product-title text-success">{{ number_format($total_price ?? 0) }} </div>
              <div class="product-subtitle">Total</div>
            </div>
            <div class="col-8 col-md-3">
              <button type="submit" class="btn btn-success mt-4 px-4 btn-block">
                Checkout Now
              </button>
            </div>
          </div>

        </form>

      </div>
    </section>
  
  </div>
@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  var locations = new Vue({ 
    el: "#locations", //membuat elemen dengan id gallery yang mana di hande oleh vue js
    mounted() { //
      AOS.init();
      this.getProvincesData();
    },
    //vueJs berjalan di client server
    data: {
      provinces: null,
      regencies: null,
      provinces_id: null,
      regencies_id: null,
    },
    //methode menyimpan fungsi2 di vue
    methods:{
      getProvincesData(){
        var self = this;
        axios.get('{{ route('api-provinces') }}')
        //action
          .then(function(response){
            self.provinces = response.data;
          })
      },
      getRegenciesData(){
        var self = this;
        axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
        //action
          .then(function(response){
            self.regencies = response.data;
          })
      },
    },
     //watch melihat data jika ada perubahan sesuatu
     watch:{
      provinces_id: function(val, oldVal){
        this.regencies_id = null;
        this.getRegenciesData();
      }
     }
   
  });
</script>
@endpush



