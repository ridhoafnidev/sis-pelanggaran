@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('ppiket.dpiket.index') }}">Data Piket</a>
        </li>
        <li class="breadcrumb-item active">Lihat Detail</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Detail dari : {{ $pelanggaran[0]->nama_guru }}
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>NIS</th>
                            <td>{{ $pelanggaran[0]->nis }}</td>
                        </tr>
                        <tr>
                            <th>Siswa</th>
                            <td>{{ $pelanggaran[0]->nama_siswa }}</td>
                        </tr>
                        <tr>
                            <th>Rombel</th>
                            <td>{{ $pelanggaran[0]->rombel }}</td>
                        </tr>
                        <tr>
                            <th>Pelanggaran</th>
                            <td>{{ $pelanggaran[0]->jenis_pelanggaran }}</td>
                        </tr>
                        <tr>
                            <th>Petugas</th>
                            <td>{{ $pelanggaran[0]->nama_petugas }}</td>
                        </tr>
                        <tr>
                            <th>Guru</th>
                            <td>{{ $pelanggaran[0]->nama_guru }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection