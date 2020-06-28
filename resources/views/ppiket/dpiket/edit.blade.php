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
                <a href="{{ route('ppiket.dpiket.index') }}">Data Piket</a>
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
                    @include('ppiket.dpiket._form-log')
                </div>
                @endif 
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        Edit Data Piket
                    </div>
                    <?php if($pelanggaran[0]->ajukan == "Diproses"){?>
                        {!! Form::model($pelanggaran, ['route' => ['ppiket.dpiket.update', $dataPelanggaran[0]->id], 'method' => 'PUT']) !!}
                            @include('ppiket.dpiket._form-edit')
                        {!! Form::close() !!}   
                    <?php }else if($pelanggaran[0]->ajukan == "Diajukan") {?>
                        {!! Form::model($pelanggaran, ['route' => ['ppiket.dpiket.update', $dataPelanggaran[0]->id], 'method' => 'PUT']) !!}
                            @include('ppiket.dpiket._form-edit-diajukan')
                        {!! Form::close() !!}
                    <?php }else{ ?>
                        {!! Form::model($pelanggaran, ['route' => ['ppiket.dpiket.update', $dataPelanggaran[0]->id], 'method' => 'PUT']) !!}
                            @include('ppiket.dpiket._form-edit')
                        {!! Form::close() !!}
                    <?php }?> 
                </div>
            </div>
        </div>
    </div>
@endsection