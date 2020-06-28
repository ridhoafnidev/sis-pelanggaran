@extends('layouts.admin.app')
<style>
    img{
        border-radius: 10px;
    }
</style>
@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('bkonseling.konseling.index') }}">Data Konseling Siswa</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-black bg-default">
                        Edit Data Konseling Siswa
                    </div>
                    {!! Form::model($pelanggaran, ['route' => ['bkonseling.konseling.update', $dataPelanggaran[0]->id], 'method' => 'PUT']) !!}
                        @include('ppiket.konseling._form-edit')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection