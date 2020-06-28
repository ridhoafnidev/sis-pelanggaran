@extends('layouts.pgerbang.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <!-- <li class="breadcrumb-item active">My Dashboard</li> -->
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Dashboard
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5 class="card-title">Welcome, {{ Auth::user()->name }}</h5>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
