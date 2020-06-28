@extends('layouts.admin.app')

@section('content')


<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{route('wakasis.wakasis.siswa')}}">Data Siswa</a>
      </li>
      <li class="breadcrumb-item active">Detail Siswa</li>
    </ol>
     <!--Icon Cards-->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-white bg-primary">
           Info Siswa
          </div>
          <div class="card-body">
              <table class="table table-striped">
                  
                  <tr>
                      <th>Nama </th>
                      <td>{{$siswa[0]->nama_lengkap}}</td>
                  </tr>
                  <tr>
                      <th>NIS</th>
                      <td>{{$siswa[0]->nis}}</td>
                  </tr>
                  <tr>
                      <th>Alamat</th>
                      <td>{{$siswa[0]->alamat}}</td>
                  </tr>
                  <tr>
                      <th>Tempat Lahir</th>
                      <td>{{$siswa[0]->tempat_lahir}}</td>
                  </tr>
                  <tr>
                      <th>Tanggal Lahir</th>
                      <td>{{$siswa[0]->tanggal_lahir}}</td>
                  </tr>
                  <tr>
                      <th>Jenis Kelamin</th>
                      <td>{{$siswa[0]->jenis_kelamin}}</td>
                  </tr>
                  <tr>
                      <th>Rombel</th>
                      <td>{{$siswa[0]->rombel}}</td>
                  </tr>
                  <tr>
                      <th>Jurusan</th>
                      <td>{{$siswa[0]->jurusan}}</td>
                  </tr>
                  <tr>
                      <th>Foto</th>
                      <td><img src="{{ asset($siswa[0]->foto) }}" alt="Foto Siswa" height="150" width="150"></td>
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection