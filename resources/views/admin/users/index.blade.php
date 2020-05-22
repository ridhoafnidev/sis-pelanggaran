@extends('layouts.admin.app')

@section('assets-top')
    <!-- Page level plugin CSS-->
    <link href="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Users</a>
          </li>
          <li class="breadcrumb-item active">Table</li>
        </ol>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-list"></i> Users
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">Add New</a>
          </div>
          <div class="card-body table-responsive">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th></th>
                  </tr>
                </thead>
                <tfoot>
                   <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th></th>
                  </tr>
                </tfoot>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('assets-bottom')
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('assets/blog-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/blog-admin/vendor/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/blog-admin/vendor/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('api.datatable.users') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user', name: 'user'},
                    {data: 'email', name: 'email'},
                    {data: 'level', name: 'level'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })
        });
    </script>
@endsection