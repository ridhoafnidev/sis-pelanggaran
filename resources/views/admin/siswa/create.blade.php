@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Categories</a>
        </li>
        <li class="breadcrumb-item active">Add New</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Add New Category
                </div>
                {!! Form::open(['route' => 'admin.categories.store', 'method' => 'POST']) !!}
                    @include('admin.categories._form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection