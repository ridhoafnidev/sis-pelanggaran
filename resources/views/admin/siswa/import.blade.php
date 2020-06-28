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
              <div class="card-body">
                        <form action="{{ route('admin.siswa.mulai-import') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }} 
                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-success">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="">File (.xls, .xlsx)</label>
                                <input type="file" class="form-control" name="file">
                                <p class="text-danger">{{ $errors->first('file') }}</p>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm">Upload</button>
                            </div>
                        </form>
                    </div>
            </div>
          </div>
        </div>
    </div>
@endsection
