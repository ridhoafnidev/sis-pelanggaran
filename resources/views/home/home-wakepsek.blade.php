<style>
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 60%;
}
</style>
@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <!-- <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
    </ol> -->
    <div class="row" style="margin-top:90px;">
        <div class="col-md-12">
        <div class="center">
        <img src="images/welcome.png" alt="Avatar" class="center">
        <h4 style="text-align:center">Selamat Datang</h4>
        <h5  style="text-align:center">{{ Auth::user()->name }}</h5>
        </div>

        </div>
    </div>
    </div>
@endsection
