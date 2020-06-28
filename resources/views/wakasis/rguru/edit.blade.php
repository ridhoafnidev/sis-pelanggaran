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
                <a href="{{ route('wakasis.wakasis.rguru') }}">Data Kehadiran Guru</a>
            </li>
            <li class="breadcrumb-item active">Rincian</li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-black bg-default">
                        Rincian Data Kehadiran Guru
                    </div>
                    
                        @include('wakasis.rguru._form')
                    
                </div>
            </div>
        </div>
    </div>
@endsection