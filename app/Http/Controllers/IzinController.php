<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\Guru;
use Session;
use App\Pelanggaran;
use App\Settings;
use App\TahunAjaran;
use App\Izin;
use App\IzinDetail;
use App\IzinGerbang;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Carbon\Carbon;

class IzinController extends Controller
{

    public function __construct()
    {
        if(Auth::user()['role'] == 'Petugas Piket Teknik Komputer Jaringan'){
            $this->middleware('role:Petugas Piket Teknik Komputer Jaringan');
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Audio Video'){
            $this->middleware('role:Petugas Piket Teknik Audio Video');
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Kelistrikan'){
            $this->middleware('role:Petugas Piket Teknik Kelistrikan');
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Multimedia'){
            $this->middleware('role:Petugas Piket Teknik Multimedia');
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Pemesinan'){
            $this->middleware('role:Petugas Piket Teknik Pemesinan');
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Kendaraan'){
            $this->middleware('role:Petugas Piket Teknik Kendaraan');
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Sepeda Motor'){
            $this->middleware('role:Petugas Piket Teknik Sepeda Motor');
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Pendingin'){
            $this->middleware('role:Petugas Piket Teknik Pendingin');
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Design Pemodelan Dan Informasi Bangunan'){
            $this->middleware('role:Petugas Piket Teknik Design Pemodelan Dan Informasi Bangunan');
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Rekayasa Perangkat Lunak'){
            $this->middleware('role:Petugas Piket Teknik Rekayasa Perangkat Lunak');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ppiket.izin.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jpelanggaran = DB::table('jenis_pelanggaran')->get();
        if(Auth::user()->role == 'Petugas Piket Teknik Komputer Jaringan'){
            $kelas = DB::table('kelas')->where('jurusan', 'JRTKJ')->orderBy('kelas', 'asc')->get();
        }elseif(Auth::user()->role == 'Petugas Piket Teknik Audio Video'){
            $kelas = DB::table('kelas')->where('jurusan', 'JRAV')->orderBy('kelas', 'asc')->get();
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Kelistrikan'){
            $kelas = DB::table('kelas')->where('jurusan', 'JRTITL')->orderBy('kelas', 'asc')->get();
        }elseif(Auth::user()['role'] == 'Petugas Piket Multimedia'){
            $kelas = DB::table('kelas')->where('jurusan', 'JRMM')->orderBy('kelas', 'asc')->get();
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Pemesinan'){
            $kelas = DB::table('kelas')->where('jurusan', 'JRTP')->orderBy('kelas', 'asc')->get();
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Kendaraan'){
            $kelas = DB::table('kelas')->where('jurusan', 'JRKR')->orderBy('kelas', 'asc')->get();
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Sepeda Motor'){
            $kelas = DB::table('kelas')->where('jurusan', 'JRTBSM')->orderBy('kelas', 'asc')->get();
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Pendingin'){
            $kelas = DB::table('kelas')->where('jurusan', 'JRTP')->orderBy('kelas', 'asc')->get();
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Design Pemodelan Dan Informasi Bangunan'){
            $kelas = DB::table('kelas')->where('jurusan', 'JRDPIB')->orderBy('kelas', 'asc')->get();
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Rekayasa Perangkat Lunak'){
            $kelas = DB::table('kelas')->where('jurusan', 'JRRPL')->orderBy('kelas', 'asc')->get();
        }
        return view('ppiket.izin.create', compact('kelas', 'jpelanggaran'));
    }

    public function devkelas(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $siswa = Siswa::where('rombel', $value)->get();
        $output = '<option value="">Pilih Siswa</option>';
        foreach ($siswa as $row) {
            $output .= '<option value="' . $row->nis . '">' . $row->nama_lengkap . "-(" . $row->nis . ")" . '</option>';
        }

        echo $output;
    }

    public function devsiswa(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $siswa = Siswa::where('nis', $value)->get();
        foreach ($siswa as $row) {
            $output1 = '<label>Nama : ' . $row->nama_lengkap . '</label>';
            $output2 = '<label>NIS : ' . $row->nis . '</label>';
            $output3 = '<label>Rombel : ' . $row->rombel . '</label>';
            $output4 = '<label><img src="' . $row->foto . '" alt="Foto" height="100" width="100"> </label>';

            echo $output4 . "<br>";
            echo $output1 . "<br>";
            echo $output2 . "<br>";
            echo $output3 . "<br>";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required|string|min:3|unique:email'
        // ]);

        if ($request->ajax()) {
            $set = Settings::all();
            $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
            $rules = array(
                'kelas.*'  => 'required',
                'siswa.*'  => 'required',
                'keterangan_izin.*'  => 'required',
                'nama_petugas'  => 'required',
                'guru_id'  => 'required',
                'kehadiran_id'  => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error'  => $error->errors()->all()
                ]);
            }

            $pelanggaran = new Izin;
            $pelanggaran->guru_id = $request->guru_id;
            $pelanggaran->kehadiran_id = $request->kehadiran_id;
            $pelanggaran->nama_petugas = $request->nama_petugas;
            $pelanggaran->tahun_ajaran_id = $ta[0]->id;
            $pelanggaran->save();
            if ($pelanggaran->save()) {
                $kelas = $request->kelas;
                $siswa = $request->siswa;

                $pelanggarans = $request->keterangan_izin;
                for ($count = 0; $count < count($siswa); $count++) {
                    $data = array(
                        'izin_id' => $pelanggaran->id,
                        'nis'  => str_pad($siswa[$count], 10, "0", STR_PAD_LEFT),
                        'keterangan_izin'  => $pelanggarans[$count],
                        'datetime' => Carbon::now()
                    );
                    $insert_data[] = $data;
                }
                $save = IzinDetail::insert($insert_data);
                if ($save) {
                    $k = IzinDetail::where('izin_id', $pelanggaran->id )->get();
                   // return $k;
                   for($count = 0; $count < count($k); $count++)
                   {
                       $datas = array(
                       'izin_detail_id' => $k[$count]->id,
                       'keluar' => "Y",
                       'masuk' => "N"
                       );
                       $insert_data_kon[] = $datas; 
                   }
                   IzinGerbang::insert($insert_data_kon);
                    return response()->json([
                        'success'  => 'Data berhasi ditambah.'
                    ]);
                }
            }
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
            ->WHERE('pelanggaran_detail.id', '=', $id)
            ->select(['pelanggaran_detail.*', 'pelanggaran.guru_id', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->get();
        return view('ppiket.dpiket.show', compact('pelanggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggaran = DB::table('pelanggaran_detail')
            ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
            ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
            ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
            ->WHERE('pelanggaran_detail.id', '=', $id)
            ->select(['pelanggaran_detail.*', 'pelanggaran.guru_id', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'kehadiran.kode_kehadiran', 'siswa.*', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->get();
        $jpelanggaran = DB::table('jenis_pelanggaran')->get();
        $kelas = DB::table('kelas')->get();
        $guru = DB::table('guru')->get();
        $kehadiran = DB::table('kehadiran')->get();

        $dataPelanggaran = $pelanggaran;

        return view('ppiket.dpiket.edit', compact('pelanggaran', 'jpelanggaran', 'kelas', 'kehadiran', 'guru', 'dataPelanggaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // $this->validate($request, [
        //     'title' => 'required|string|min:3|unique:email,' 
        // ]);

        $pelanggaran_id = $request->id_pelanggaran;
        $pelanggaran = Pelanggaran::findOrFail($pelanggaran_id);
        $pelanggaran->guru_id = $request->guru_id;
        $pelanggaran->kehadiran_id = $request->kehadiran_id;
        $pelanggaran->nama_petugas = $request->nama_petugas;
        if ($pelanggaran->update()) {
            $pDetail = PelanggaranDetail::findOrFail($id);
            $pDetail->jenis_pelanggaran_id = $request->pelanggaran;
            if ($pDetail->update()) {
                Session::flash('success', 'Data berhasil diubah!');
                return redirect()->route('ppiket.dpiket.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Guru::destroy($id)) return redirect()->back();
        return redirect()->route('admin.guru.index');
    }

    public function dataTable()
    {
        // $pelanggaran = Pelanggaran::query();
        $pelanggaran = DB::table('izin_detail')
            ->join('izin', 'izin.id', '=', 'izin_detail.izin_id')
            ->join('siswa', 'siswa.nis', '=', 'izin_detail.nis')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->select(['izin_detail.*', 'izin.guru_id', 'izin.kehadiran_id', 'izin.nama_petugas', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->get();

        return DataTables::of($pelanggaran)
            ->addColumn('action', function ($pelanggaran) {
                return view('layouts.ppiket.partials.pelanggaran._action', [
                    'model' => $pelanggaran,
                    'show_url' => route('ppiket.dpiket.show', $pelanggaran->id),
                    'edit_url' => route('ppiket.dpiket.edit', $pelanggaran->id),
                    'delete_url' => route('ppiket.dpiket.destroy', $pelanggaran->id)
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
