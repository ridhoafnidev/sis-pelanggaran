<?php

namespace App\Exports;
use DB;
use App\Settings;
use App\TahunAjaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class RekapKehadiranGuruCustomExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();

        $kehadiran_guru = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('izin_detail', 'izin_detail.izin_id', '=', 'izin.id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'izin.tahun_ajaran_id')
            ->select(['izin.*','tahun_ajaran.tahun_ajaran', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->where('izin.tahun_ajaran_id','=',$ta[0]->id)
            ->groupBy('izin.guru_id') 
            ->get();

            return view('wakasis.rguru._excel-rekap-guru', [
                'kehadiran_guru' => $kehadiran_guru
            ]);

    }
}
