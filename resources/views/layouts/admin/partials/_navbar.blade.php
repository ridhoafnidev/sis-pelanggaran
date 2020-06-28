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
                    <a href="{{ route('admin.guru.index') }}">Kelas</a>
                </li>
                <li>
                    <a href="{{ route('admin.guru.index') }}">Jenis Pelanggaran</a>
                </li>
                <li>
                    <a href="{{ route('admin.guru.create') }}">Jenis Kehadiran</a>
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
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Logout</a> 
            </li>
            </ul>
        </div>
    </nav>

<?php }elseif(Auth::user()->role == 'Petugas Piket Teknik Komputer Jaringan' || Auth::user()->role == 'Petugas Piket Teknik Audio Video' || Auth::user()->role == 'Petugas Piket Teknik Pemesinan' || Auth::user()->role == 'Petugas Piket Multimedia'  || Auth::user()->role == 'Petugas Piket Teknik Kendaraan'  || Auth::user()->role == 'Petugas Piket Teknik Sepeda Motor'  || Auth::user()->role == 'Petugas Piket Teknik Pendingin' || Auth::user()->role == 'Petugas Piket Teknik Design Pemodelan Dan Informasi Bangunan' || Auth::user()->role == 'Petugas Piket Teknik Rekayasa Perangkat Lunak' ){ ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="{{ route('admin.index') }}">{{ config('app.name', 'IDBlog') }}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item {{Request::path() == 'ppiket/dpiket/create' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Isi Data Piket">
                <a class="nav-link" href="{{ route('ppiket.dpiket.create') }}">
                <i class="fa fa-fw fa-plus"></i>
                <span class="nav-link-text ">Isi Data Piket</span>
                </a>
            </li>
            <li class="nav-item {{Request::path() == 'ppiket/izin/create' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Form Izin Siswa">
                <a class="nav-link" href="{{ route('ppiket.izin.create') }}">
                <i class="fa fa-fw fa-users"></i>
                <span class="nav-link-text">Form Izin Siswa</span>
                </a>
            </li>
            <li class="nav-item {{Request::path() == 'ppiket/dpiket' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Perubahan Data Piket">
                <a class="nav-link" href="{{ route('ppiket.dpiket.index') }}">
                <i class="fa fa-fw fa-edit"></i>
                <span class="nav-link-text">Perubahan Data Piket</span>
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
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
            </ul>
        </div>
    </nav>
<?php }elseif(Auth::user()->role == 'Bimbingan Konseling'){ ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="{{ route('admin.index') }}">{{ config('app.name', 'IDBlog') }}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item {{Request::path() == 'admin' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Beranda">
                <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text ">Beranda </span>
                </a>
            </li>
            <li class="nav-item {{Request::path() == 'bkonseling/konseling' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Konseling">
                <a class="nav-link" href="{{ route('bkonseling.konseling.index') }}">
                <i class="fa fa-fw fa fa-heartbeat"></i>
                <span class="nav-link-text">Konseling</span>
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
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
            </ul>
        </div>
    </nav>
<?php }elseif(Auth::user()->role == 'Petugas Gerbang'){?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="{{ route('pgerbang.index') }}">{{ config('app.name', 'IDBlog') }}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item {{Request::path() == 'pgerbang' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{ route('pgerbang.index') }}">
                <i class="fa fa-fw fa-home"></i>
                <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{Request::path() == 'pgerbang/izin' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Comments">
                <a class="nav-link" href="{{ route('pgerbang.izin') }}">
                <i class="fa fa-fw fa-users"></i>
                <span class="nav-link-text">Data Izin Siswa</span>
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
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
            </ul>
        </div>
    </nav>
<?php }elseif(Auth::user()->role == 'Wakil Kepala Sekolah Kesiswaan'){?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="{{ route('wakasis.index') }}">{{ config('app.name', 'ISekolah') }}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item {{Request::path() == 'wakasis' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{ route('wakasis.index') }}">
                <i class="fa fa-fw fa-home"></i>
                <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{Request::path() == 'wakasis/wakasis/akumulasi_pelanggaran' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Rekap Siswa">
                <a class="nav-link" href="{{ route('wakasis.wakasis.apelanggaran') }}">
                <i class="fa fa-fw fa fa fa-balance-scale"></i>
                <span class="nav-link-text">Akumulasi Pelanggaran</span>
                </a>
            </li>
            <li class="nav-item {{Request::path() == 'wakasis/wakasis/siswa' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Rekap Siswa">
                <a class="nav-link" href="{{ route('wakasis.wakasis.siswa') }}">
                <i class="fa fa-fw fa fa-users"></i>
                <span class="nav-link-text">Data Siswa</span>
                </a>
            </li>
            <li class="nav-item {{Request::path() == 'wakasis/wakasis/rekap_siswa' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Rekap Siswa">
                <a class="nav-link" href="{{ route('wakasis.wakasis.rsiswa') }}">
                <i class="fa fa-fw fa fa-vcard"></i>
                <span class="nav-link-text">Rekap Siswa</span>
                </a>
            </li>
            <li class="nav-item {{Request::path() == 'wakasis/wakasis/rekap_guru' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Rekap Guru">
                <a class="nav-link" href="{{ route('wakasis.wakasis.rguru') }}">
                <i class="fa fa-fw fa fa-vcard-o"></i>
                <span class="nav-link-text">Rekap Guru</span>
                </a>
            </li>
            <li class="nav-item {{Request::path() == 'wakasis/wakasis/rekap_izin' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Rekap PBM">
                <a class="nav-link" href="{{ route('wakasis.wakasis.rizin') }}">
                <i class="fa fa-fw fa fa-credit-card-alt"></i>
                <span class="nav-link-text">Rekap PBM</span>
                </a>
            </li>
            <li class="nav-item {{Request::path() == 'wakasis/wakasis/rekap_perubahan_data' ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Perubahan Data">
                <a class="nav-link" href="{{ route('wakasis.wakasis.rperdata') }}">
                <i class="fa fa-fw fa-pencil-square"></i>
                <span class="nav-link-text">Perubahan Data</span>
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
             <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <?php 
            $set = App\Settings::all();
            $ta = App\TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
            $pelanggaran_siswa = DB::table('konseling')
            ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
            ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'pelanggaran_detail.tahun_ajaran_id')
            ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id') 
            ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
            ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
            ->select(['konseling.*', 'pelanggaran_detail.*', DB::raw('SUM(jenis_pelanggaran.poin) AS total'), 'konseling.id as id_konseling', 'tahun_ajaran.tahun_ajaran', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jenis_pelanggaran.poin as poin', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nis', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->where('pelanggaran_detail.tahun_ajaran_id', $ta[0]->id)
            ->groupBy('pelanggaran_detail.nis')
            ->get();
            for($i=0; $i < sizeof($pelanggaran_siswa); $i++){
                if($pelanggaran_siswa[$i]->total > 50){
                    $siswa = App\NotifPelanggaran::where('nis', $pelanggaran_siswa[$i]->nis)->first();
                    if($siswa == null){
                        $notif = new App\NotifPelanggaran;
                        $notif->nis = $pelanggaran_siswa[$i]->nis;
                        $notif->total_poin = $pelanggaran_siswa[$i]->total;
                        $notif->tahun_ajaran_id = $pelanggaran_siswa[$i]->tahun_ajaran_id;
                        $notif->save();
                    }else{
                        $siswa->nis = $pelanggaran_siswa[$i]->nis;
                        $siswa->total_poin = $pelanggaran_siswa[$i]->total;
                        $siswa->tahun_ajaran_id = $pelanggaran_siswa[$i]->tahun_ajaran_id;
                        $siswa->status = 0;
                        $siswa->update();
                    }
                    
                } ;
            }
            $poin = App\NotifPelanggaran::where('status', 0)->orderBy('id', 'desc')->limit(10)->get();
           ?>
           @if( count($poin) == 0 )
            
           @else
                <span class="badge badge-danger navbar-badge"> {{count($poin)}} </span>
            
           @endif
             
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- <notification  v-for="(notif, index) in getNotifications"  v-bind:key="index" :msg="notif.user_name+' Membuat Item baru'" link="item" :id="notif.id" />           -->
          <h6 class="p-3 mb-0">{{ count($poin) }} Notifikasi</h6>
          <div class="dropdown-divider"></div>   

          @foreach ($poin as $po)
          @php $siswa = App\Siswa::where('nis', $po->nis)->first() @endphp
            <span>
                <!-- <a href="{{ route('wakasis.wakasis.show.npelanggaran', $po->nis) }}"><label style="padding-left:25px;"> </label></a> -->
                <a href="{{ route('wakasis.wakasis.show.npelanggaran', $po->nis) }}" class="dropdown-item dropdown-footer">{{$siswa->nama_lengkap}} poin <span class="badge badge-danger navbar-badge"> {{$po->total_poin}} </span></a>
                
                <div class="dropdown-divider"></div>   
            </span> 
            <!-- <a href="#" class="dropdown-item dropdown-footer">{{$po->nis}} akumulasi poin <span class="badge badge-pill badge-primary" style="padding:2px; corner:5px;" >{{$po->total_poin}}</span></a> -->
          @endforeach
        <a href="{{ route('wakasis.wakasis.npelanggaran') }}" class="dropdown-item dropdown-footer"><b>Lihat Semua Notifikasi</b></a>
        </div>
      </li>
            <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-bell"></i></a>
                </li> -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
            </ul>
        </div>
    </nav>

<?php }else{

} ?>