@extends('backend.main_b.dashboard-admin')

@section('title')
    User Page
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">User</h2>
        <p class="dashboard-subtitle"> List of Users </p>
      </div>
      <div class="dashboard-content">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
                            + Tambah User Baru
                        </a>

                        <div class="table-responsive">
                            <table class="table table-hover scroll-horizontal-vertical w-100" id="myTable">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Rule</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->roles }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                                        Aksi
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('user.edit', $item->id ) }}"> Edit </a>
                                                        <form action="{{ route('user.destroy', $item->id) }}" method="POST" >
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </td> 
                                    </tr>
                                  @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script>
       $(document).ready( function () {
        $('#myTable').DataTable();
        } );
    </script>
@endpush