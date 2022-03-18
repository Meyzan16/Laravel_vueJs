@extends('backend.main_b.dashboard-admin')

@section('title')
    User Edit Page
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">User Edit</h2>
        <p class="dashboard-subtitle"> Edit User </p>
      </div>
      <div class="dashboard-content">
         <div class="row">
             <div class="col-md-12">
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                 <div class="card">
                     <div class="card-body">
                        <form action="{{ route('user.update' , $item->id) }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama User</label>
                                            <input type="text" name="name" value="{{ $item->name }}" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email User</label>
                                            <input type="text"value="{{ old('email', $item->email) }}" name="email" class="form-control @error('email')is-invalid @enderror" required>
                                            @error('email') 
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Password User</label>
                                            <input type="text" name="password"  class="form-control">
                                            <small style="color: red">Kosongkan jika tidak ingin diganti</small>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group" required>
                                            <label>Roles</label>
                                            <select name="roles" class="form-control" required>
                                                @if($item->roles == 'USER' )
                                                    <option value="{{ $item->roles }}" selected> {{ $item->roles }} </option>
                                                    <option value="ADMIN"> ADMIN </option>      
                                                @elseif($item->roles == 'ADMIN' )
                                                    <option value="{{ $item->roles }}" selected> {{ $item->roles }} </option>
                                                    <option value="USER">USER</option>    
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                            Save 
                                        </button>
                                    </div>
                                </div>
                        </form>
                     </div>
                 </div>
             </div>
         </div>
      </div>
    </div>
</div>
@endsection

