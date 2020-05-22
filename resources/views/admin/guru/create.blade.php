@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Guru</a>
        </li>
        <li class="breadcrumb-item active">Add New</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Tambah Guru Baru
                </div>
                {!! Form::open(['route' => 'admin.guru.store', 'method' => 'POST']) !!}
                    @include('admin.guru._form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection