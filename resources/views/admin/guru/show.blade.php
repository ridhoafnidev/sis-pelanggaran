@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Guru</a>
        </li>
        <li class="breadcrumb-item active">Show Detail</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Guru Detail : {{ $guru->nama_lengkap }}
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>NIP</th>
                            <td>{{ $guru->nip }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $guru->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $guru->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection