<?php
    if (Auth::user()->role == 'Administrator') {
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('admin.index') }}">{{ config('app.name', 'IDBlog') }}</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Posts">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-database"></i>
            <span class="nav-link-text">Data Master</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
                <a href="{{ route('admin.categories.index') }}">Kelas</a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}">Jenis Pelanggaran</a>
            </li>
            <li>
                <a href="{{ route('admin.posts.create') }}">Jenis Kehadiran</a>
            </li>
            <li>
                <a href="{{ route('admin.siswa.index') }}">Siswa</a>
            </li>
            <li>
                <a href="{{ route('admin.guru.index') }}">Guru</a>
            </li>
            </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Comments">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">Pengguna</span>
            </a>
        </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
            </a>
        </li>
        </ul>
        <ul class="navbar-nav ml-auto">
        
        <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for...">
                <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                </button>
                </span>
            </div>
            </form>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
        </ul>
    </div>
</nav>

<?php }elseif(Auth::user()->role == 'Petugas Piket'){ ?>

<?php }elseif(Auth::user()->role == 'Bimbingan Konseling'){ ?>

<?php }elseif(Auth::user()->role == 'Petugas Gerbang'){?>

<?php }elseif(Auth::user()->role == 'Wakil Kepala Sekolah Kesiswaan'){?>

<?php }else{
    
} ?>