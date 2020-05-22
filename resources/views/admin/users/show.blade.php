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
    <!-- Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
            User Detail : {{ $user->name }}
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  <tr>
                      <th>ID</th>
                      <td>{{ $user->id }}</td>
                  </tr>
                  <tr>
                      <th>Name</th>
                      <td>{{ $user->name }}</td>
                  </tr>
                  <tr>
                      <th>E-Mail</th>
                      <td>{{ $user->email }}</td>
                  </tr>
                  <tr>
                      <th>Role</th>
                      <td>{{ $user->role }}</td>
                  </tr>
                  <tr>
                      <th>Avatar</th>
                      <td><img src="{{ asset($user->avatar) }}" alt="Avatar" height="150" width="150"></td>
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection