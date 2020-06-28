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
            <a href="{{route('wakasis.index')}}">Data Izin Siswa</a>
        </li>
        <li class="breadcrumb-item active">Table</li>
    </ol>
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
    </div>
    @endif
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-list"></i> Data Izin Siswa

        </div>
        <div class="card-body table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <!--  <th>Keterangan</th> -->
                            <th>Lama Izin</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <!--  <th>Keterangan</th> -->
                            <th>Lama Izin</th>

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
    $(document).ready(function() {
        $("#dataTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.datatable.rizin') }}",
            columns: [

                {
                    data: 'nama_siswa',
                    name: 'nama_siswa'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'jurusan',
                    name: 'jurusan',
                    // render: function(data) {
                    //     if (data == 'Y') {
                    //         return "Ya";
                    //     } else {
                    //         return "Tidak";
                    //     }
                    // }

                },
                {
                    data: 'kelas_siswa',
                    name: 'kelas_siswa'
                    // render: function(data) {
                    //     if (data == 'Y') {
                    //         return "Ya";
                    //     } else {
                    //         return "Tidak";
                    //     }
                    // }
                },
                {
                    data: 'lama_izin',
                    name: 'lama_izin'
                }


            ]
        });
    });
</script>
@endsection