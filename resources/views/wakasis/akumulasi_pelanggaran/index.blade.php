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
                <a href="{{route('wakasis.index')}}">Rekap Pelanggaran Siswa</a>
            </li>
            <li class="breadcrumb-item active">Tabel</li>
        </ol>
        @if(Session::has('berhasil'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('berhasil') }}
            </div>
            @elseif(Session::has('gagal'))
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('gagal') }}
            </div>
            @elseif(Session::has('kosong'))
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('kosong') }}
            </div>
            @else
        @endif
        <div class="card mb-3">
            <div class="card-header">
            <a href="{{ route('wakasis.wakasis.mulai_akumulasi_pelanggaran') }}" class="btn btn-sm btn-primary"><i class="fa fa fa-cogs"></i> Akumulasi Pelanggaran</a>
             <div class="float-right form-inline" >
                    <select name="filter_ta" id="filter_ta"  class="form-control mb-2 mr-sm-2">
                    <option value="">-Pilih Tahun Ajaran-</option
                    >@foreach ($ta as $th)
                        <option value="{{ $th->id }}" >
                        {{  $th->tahun_ajaran }}
                        </option>
                    @endforeach
                    </select>
                    <!-- <input type="email" class="form-control mb-2 mr-sm-2" placeholder="Enter email" id="email"> -->
                    <button type="button" name="filter" id="filter" class="btn btn-primary mb-2">Filter</button> | 
                    <button type="button" name="reset" id="reset" class="btn btn-warning mb-2">Reset</button>
                </div>
            </div>
           
            <div class="card-body table-responsive">
            
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Siswa</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Poin</th>
                                <th>TA</th>
                                <th>Pelanggaran</th>
                                <th>Poin</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Siswa</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Poin</th>
                                <th>TA</th>
                                <th>Pelanggaran</th>
                                <th>Poin</th>
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

        fill_datatable();

        function download_data(filter_ta = ''){
            alert(filter_ta);
            var url = "{{ route('wakasis.wakasis.cetak.rsiswa', "") }}"+"/"+filter_ta;
            window.location = url;
        }

        function fill_datatable(filter_ta = ''){
            var dataTables = $('#dataTable').DataTable({
            order: [ [0, 'desc'] ],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('wakasis.wakasis.apelanggaran') }}",
                data: {filter_ta:filter_ta}
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'nama_siswa', name: 'nama_siswa'},
                {data: 'jurusan', name: 'jurusan'},
                {data: 'rombel', name: 'rombel'},
                {data: 'total_poin', name: 'total_poin'},
                {data: 'tahun_ajaran', name: 'tahun_ajaran'},
                {data: 'jenis_pelanggaran', name: 'jenis_pelanggaran'},
                {data: 'poin', name: 'poin'}
            ] 
            });
        }

        $('#filter').click(function(){
            var filter_ta = $('#filter_ta').val();
            if(filter_ta != '')
            {
                $('#dataTable').DataTable().destroy();
                fill_datatable(filter_ta);
            }else{
                alert('Pilih dulu filternya');
            }
        });

        $('#btn_download').click(function(){
            var filter_ta = $('#filter_ta').val();
            if(filter_ta != '')
            {
                download_data(filter_ta);
            }else{
                download_data(0);
            }
        });

        $('#reset').click(function(){
            var filter_ta = $('#filter_ta').val('');
            $('#dataTable').DataTable().destroy();
            fill_datatable();
        });
        
    });

</script>
@endsection
