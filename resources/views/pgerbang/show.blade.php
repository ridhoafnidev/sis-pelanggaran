@extends('layouts.admin.app')

@section('content')


<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Users</a>
      </li>
      <li class="breadcrumb-item active">Show Detail</li>
    </ol>
     <!--Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            User Detail : {{ $izin->name }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  
                  <tr>
                      <th>Masuk</th>
                      <td>{{ $izin->masuk }}</td>
                  </tr>
                  <tr>
                      <th>Keluar</th>
                      <td>{{ $izin->keluar }}</td>
                  </tr>
                  <tr>
                      <th>Tidak Masuk</th>
                      <td>{{ $izin->tidak_masuk }}</td>
                  </tr>
                  
              </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection