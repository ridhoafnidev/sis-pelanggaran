<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\Guru;
use Session;
use App\Pelanggaran;
use App\Izin;
use App\Settings;
use App\TahunAjaran;
use App\Konseling;
use App\IzinDetail;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use DB;

class KonselingController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:Bimbingan Konseling');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       return view('ppiket.konseling.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jpelanggaran = DB::table('jenis_pelanggaran')->get();
        $kelas = DB::table('kelas')->get();
        return view('ppiket.izin.create', compact('kelas', 'jpelanggaran'));
    }

    public function devkelas(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $siswa = Siswa::where('rombel', $value )->get();
        $output = '<option value="">Pilih Siswa</option>';
        foreach($siswa as $row)
        {
            $output .= '<option value="'.$row->nis.'">'.$row->nama_lengkap. "-(" .$row->nis.")".'</option>';
        }

        echo $output;

    }

    public function devsiswa(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $nisn = str_pad($value, 10, "0", STR_PAD_LEFT);
        $dependent = $request->get('dependent');
        $siswa = Siswa::where('nis', $nisn )->get();
        foreach($siswa as $row)
        {
            $output1 = '<label>Nama : '.$row->nama_lengkap.'</label>';
            $output2 = '<label>NIS : '.$row->nis.'</label>';
            $output3 = '<label>Rombel : '.$row->rombel.'</label>';
            $output4 = '<label><img src="'.$row->foto.'" alt="Foto" height="100" width="100"> </label>';
        
            echo $output4."<br>";
            echo $output1."<br>";
            echo $output2."<br>";
            echo $output3."<br>";

    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelanggaran = DB::table('pelanggaran_detail')
        ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
        ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
        ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
        ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
        ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
        ->WHERE('pelanggaran_detail.id','=',$id)
        ->select(['pelanggaran_detail.*', 'pelanggaran.guru_id', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
        ->get();
        return view('ppiket.dpiket.show', compact('pelanggaran')); 
    }

    public function edit($id)
    {
        $pelanggaran = DB::table('konseling')
        ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
        ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
        ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
        ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
        ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
        ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
        ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
        ->WHERE('pelanggaran_detail.id','=',$id)
        ->select(['konseling.*','pelanggaran_detail.*', 'konseling.id as id_konseling', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'jenis_pelanggaran.poin', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel','guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
        ->get();
        $jpelanggaran = DB::table('jenis_pelanggaran')->get();
        $kelas = DB::table('kelas')->get();
        $guru = DB::table('guru')->get();
        $kehadiran = DB::table('kehadiran')->get();

        $dataPelanggaran = $pelanggaran;

        return view('ppiket.konseling.edit', compact('pelanggaran', 'jpelanggaran', 'kelas', 'kehadiran', 'guru', 'dataPelanggaran'));
    }

    public function update(Request $request, $id)
    {

        // $this->validate($request, [
        //     'title' => 'required|string|min:3|unique:email,' 
        // ]);

            $id_konseling = $request->id_konseling;
            $pelanggaran = Konseling::findOrFail($id_konseling);
            $pelanggaran->deskripsi_penanganan = $request->deskripsi_penanganan;
            $pelanggaran->hasil_konseling = $request->hasil_konseling;
            $pelanggaran->rekomendasi = $request->rekomendasi;
            $pelanggaran->konseler = $request->konseler;
            $pelanggaran->keterangan = $request->keterangan_konseling;
            if($pelanggaran->update()){
                Session::flash('success', 'Data berhasil!');
                return redirect()->route('bkonseling.konseling.index');
            }
    }

    public function destroy($id)
    {
        if (! Guru::destroy($id)) return redirect()->back();
        return redirect()->route('admin.guru.index');
    }

    public function dataTable()
    {
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        $pelanggaran = DB::table('konseling')
        ->leftjoin('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
        ->leftjoin('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
        ->leftjoin('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
        ->leftjoin('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
        ->leftjoin('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
        ->leftjoin('guru', 'guru.id', '=', 'pelanggaran.guru_id')
        ->leftjoin('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
        ->select(['konseling.*','pelanggaran_detail.*', 'konseling.id as id_konseling', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nis', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel','guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
        ->where('pelanggaran_detail.tahun_ajaran_id','=',$ta[0]->id)
        ->groupBy('pelanggaran_detail.nis')
        ->get();
        return DataTables::of($pelanggaran)
            ->addColumn('action', function ($pelanggaran) {
                return view('layouts.ppiket.partials.konseling._action', [
                    'model' => $pelanggaran,
                    'show_url' => route('ppiket.dpiket.show', $pelanggaran->pelanggaran_id),
                    'edit_url' => route('bkonseling.konseling.edit', $pelanggaran->id),
                    'delete_url' => route('ppiket.dpiket.destroy', $pelanggaran->id)
                ]);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
