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
                <a href="#">Notifikasi Pelanggaran Siswa</a>
            </li>
            <li class="breadcrumb-item active">Table</li>
        </ol>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-list"></i> Pelanggaran Siswa
            </div>
            <div class="card-body table-responsive">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Siswa</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Akumulasi Pelanggaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Siswa</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Akumulasi Pelanggaran</th>
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
    $(document).ready(function () {
        $("#dataTable").DataTable({
            order: [ [0, 'asc'] ],
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.datatable.npelanggaran') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_lengkap', name: 'nama_lengkap'},
                {data: 'nis', name: 'nis'},
                {data: 'rombel', name: 'rombel'},
                {data: 'total_poin', name: 'total_poin'},
                // {data: 'nama_guru', name: 'nama_guru'},
                // {data: 'nama_petugas', name: 'nama_petugas'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection