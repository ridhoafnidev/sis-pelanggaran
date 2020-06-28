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
                <a href="{{ route('wakasis.wakasis.rsiswa') }}">Data Konseling Siswa</a>
            </li>
            <li class="breadcrumb-item active">Rincian</li>
        </ol>
        
        @include('wakasis.notif_pelanggaran.alert')

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-black bg-default">
                        Rincian Data Konseling Siswa
                    </div>
                    
                        @include('wakasis.rsiswa._form')
                    
                </div>
            </div>
        </div>
    </div>
@endsection