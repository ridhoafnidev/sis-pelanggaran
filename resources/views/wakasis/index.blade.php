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
            <a href="#">Data Siswa</a>
        </li>
        <li class="breadcrumb-item active">Table</li>
    </ol>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-list"></i> Data Siswa
            <a href="{{ route('wakasis.wakasis.create') }}" class="btn btn-sm btn-primary">Tambah</a>
        </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Rombel</th>
                            <th>Jurusan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Rombel</th>
                            <th>Jurusan</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
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
        $(document).ready(function() {
            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('api.datatable.siswa') }}",
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'rombel',
                        name: 'rombel'
                    },
                    {
                        data: 'jurusan',
                        name: 'jurusan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }


                ]
            });
        });
    </script>
    @endsection