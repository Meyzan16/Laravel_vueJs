@extends('backend.main_b.dashboard')

@section('title')
    Store Dashboard Product Create
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Create New Products</h2>
        <p class="dashboard-subtitle"> Look what you made today!</p>
      </div>
      
      <div class="dahsboard-content">
        <div class="row">
          <div class="col-12">
            <form action="">
              <div class="card">
                <div class="card-body">
                 <div class="row">
                   <div class="col-md-6">
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control" />
                    </div>
                   </div>

                   <div class="col-md-6">
                    <div class="form-group">
                      <label>Price</label>
                      <input type="number" class="form-control" />
                    </div>
                   </div>

                   <div class="col-md-12">
                    <div class="form-group">
                      <label>Kategori</label>
                      <select name="kategori" class="form-control">
                        <option value="" disabled>Select Category</option>
                      </select>
                    </div>
                   </div>

                   <div class="col-md-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="editor"></textarea>
                    </div>
                   </div>

                   <div class="col-md-12">
                    <div class="form-group">
                      <label>Thumbnails</label>
                      <input type="file" class="form-control" />
                      <p class="text-muted">
                        Kamu Dapat Memilih Dari 1 file
                      </p>
                    </div>
                   </div>

                   

                 </div> 

                 <div class="row">
                  <div class="col text-right">
                    <button type="submit" class="btn btn-success px-5">
                      Save Now
                    </button>
                  </div>
                </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>

    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script>
  CKEDITOR.replace( 'editor' );
</script>
@endpush