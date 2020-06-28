<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Guru</th>
            <th>Tidak Hadir Tanpa Keterangan</th>
            <th>Tidak Hadir Dengan Keterangan</th> 
            <th>Telat Hadir</th>
            <th>Cepat Keluar Kelas</th>
        </tr>
    </thead>
    <tbody> 
    @php 
    $no = 1;
    @endphp
    @for($i=0; $i < count($kehadiran_guru); $i++)
    @php
            $hadir = DB::table('izin')
                ->join('guru', 'guru.id', '=', 'izin.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
                ->WHERE('guru.id', '=', $kehadiran_guru[$i]->guru_id)
                ->WHERE('izin.kehadiran_id', '=', 'K1')
                ->WHERE('izin.tahun_ajaran_id', '=', $kehadiran_guru[$i]->tahun_ajaran_id)
                ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
                ->get(); 
    
            $thtk = DB::table('izin')
                ->join('guru', 'guru.id', '=', 'izin.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
                ->WHERE('guru.id', '=', $kehadiran_guru[$i]->guru_id)
                ->WHERE('izin.kehadiran_id', '=', 'K2')
                ->WHERE('izin.tahun_ajaran_id', '=', $kehadiran_guru[$i]->tahun_ajaran_id)
                ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
                ->get();
    
            $thdk = DB::table('izin')
                ->join('guru', 'guru.id', '=', 'izin.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
                ->WHERE('guru.id', '=', $kehadiran_guru[$i]->guru_id)
                ->WHERE('izin.kehadiran_id', '=', 'K3')
                ->WHERE('izin.tahun_ajaran_id', '=', $kehadiran_guru[$i]->tahun_ajaran_id)
                ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
                ->get();
    
            $th = DB::table('izin')
                ->join('guru', 'guru.id', '=', 'izin.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
                ->WHERE('guru.id', '=', $kehadiran_guru[$i]->guru_id)
                ->WHERE('izin.kehadiran_id', '=', 'K4')
                ->WHERE('izin.tahun_ajaran_id', '=', $kehadiran_guru[$i]->tahun_ajaran_id)
                ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
                ->get();
    
            $ckk = DB::table('izin')
                ->join('guru', 'guru.id', '=', 'izin.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
                ->WHERE('guru.id', '=', $kehadiran_guru[$i]->guru_id)
                ->WHERE('izin.kehadiran_id', '=', 'K5')
                ->WHERE('izin.tahun_ajaran_id', '=', $kehadiran_guru[$i]->tahun_ajaran_id)
                ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
                ->get();

                $count_hadir = count($hadir);
                $count_thtk = count($thtk);
                $count_thdk = count($thdk);
                $count_th = count($th);
                $count_ckk = count($ckk);
        @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $kehadiran_guru[$i]->guru }}</td>
            <td>{{ $count_hadir }}</td>
            <td>{{ $count_thtk }}</td>
            <td>{{ $count_thdk }}</td>
            <td>{{ $count_th }}</td>
            <td>{{ $count_ckk }}</td>
        </tr>
    @endfor
    </tbody>
</table>