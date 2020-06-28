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
                <a href="{{ route('wakasis.wakasis.rperdata') }}">Data Perubahan</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>

        <div class="row">
            <div class="col-md-12">
                @if (count($logPelanggaran) != 0)
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        Data Awal
                    </div>
                    @include('wakasis.rperdata._form-log')
                </div>
                @endif
                <br>
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        Data Perubahan
                    </div>
                    @if($pelanggaran[0]->ajukan == "Diajukan")
                        {!! Form::model($pelanggaran, ['route' => ['wakasis.wakasis.update.rperdata', $dataPelanggaran[0]->id], 'method' => 'PUT']) !!}
                            @include('wakasis.rperdata._form-edit-diajukan')
                        {!! Form::close() !!}   
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection