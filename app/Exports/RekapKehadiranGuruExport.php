<?php

namespace App\Exports;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class RekapKehadiranGuruExport implements FromView
{
    use Exportable;
    public $tahun_ajaran_id;
    public function __construct(string $ta)
    {
        $this->tahun_ajaran_id = $ta;
    }

    public function view(): View
    {

        $kehadiran_guru = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('izin_detail', 'izin_detail.izin_id', '=', 'izin.id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'izin.tahun_ajaran_id')
            ->select(['izin.*','tahun_ajaran.tahun_ajaran', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->where('izin.tahun_ajaran_id','=',$this->tahun_ajaran_id)
            ->groupBy('izin.guru_id') 
            ->get();

        return view('wakasis.rguru._excel-rekap-guru', [
            'kehadiran_guru' => $kehadiran_guru
        ]);

    }
}
