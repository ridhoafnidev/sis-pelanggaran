
@extends('layouts.admin.app')

@section('content')
<style>
    img{
        border-radius: 10px;
    }
</style>
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('ppiket.dpiket.index') }}">Data Izin Siswa</a>
        </li>
        <li class="breadcrumb-item active">Tambah Data Izin</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-blue bg-default">
                    Tambah Data Izin Baru
                </div>
                {!! Form::open(['method' => 'POST', 'id'=>'dynamic_form']) !!}
                    @include('ppiket.izin._form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection