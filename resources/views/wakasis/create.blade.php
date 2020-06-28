@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{route('wakasis.wakasis.siswa')}}">Data Siswa</a>
          </li>
          <li class="breadcrumb-item active">Tambah Siswa</li>
        </ol>
        <!-- Icon Cards-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header text-white bg-primary">
                Tambah Siswa Baru
              </div>
              {!! Form::open(['route' => 'wakasis.wakasis.store', 'method' => 'POST']) !!}
                @include('wakasis._form')
              {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>
@endsection
