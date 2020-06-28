@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('wakasis.wakasis.siswa')}}">Data Siswa</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        Edit Siswa
                    </div>
                    {!! Form::model($siswa, ['route' => ['wakasis.wakasis.update', $siswa->nis], 'method' => 'PUT']) !!}
                        @include('wakasis._form-update')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection