<?php

namespace App\Exports;
use DB;
use App\Settings;
use App\TahunAjaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class RekapPelanggaranSiswaCustomExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();

        $pelanggaran_siswa = DB::table('konseling')
        ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
        ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'pelanggaran_detail.tahun_ajaran_id')
        ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
        ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id') 
        ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
        ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
        ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
        ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id') 
        ->select(['konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'tahun_ajaran.tahun_ajaran', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jenis_pelanggaran.poin as poin', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nis', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
        ->groupBy('pelanggaran_detail.nis')
        ->orderBy('nama_siswa', 'asc')
        ->where('pelanggaran_detail.tahun_ajaran_id','=',$ta[0]->id)
        ->get();

        return view('wakasis.rsiswa._excel-rekap-siswa', [
            'pelanggaran_siswa' => $pelanggaran_siswa
        ]);

    }
}
