<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\Guru;
use Session;
use App\Pelanggaran;
use App\TahunAjaran;
use App\Settings;
use App\Konseling;
use App\PelanggaranDetail;
use App\PelanggaranLog;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;

class DaftarPiketController extends Controller
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
        //$this->middleware('role:Petugas Piket Teknik Komputer Jaringan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('ppiket.dpiket.index');
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
        return view('ppiket.dpiket.create', compact('kelas', 'jpelanggaran'));
    }

    public function devkelas(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $siswa = Siswa::where('rombel', "$value" )->get();
        $output = '<option value="">Pilih Siswa</option>';
        foreach($siswa as $row)
        {
            if(strlen($row->nis) == 10){
                $nisn = $row->nis;
            }else{
                $nisn = str_pad($row->nis, 10, "0", STR_PAD_LEFT);
            }
            $output .= ' <option value="'.(float)$row->nis.'">'.$row->nama_lengkap. "-(" .$nisn.")".'</option>';
        }
        echo $output;
    }

    public function devsiswa(Request $request)
    { 
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        if(strlen($value) == 10){
            $nisn = $value;
        }else{
            $nisn = str_pad($value, 10, "0", STR_PAD_LEFT);
        }
        $siswa = Siswa::where('nis', $nisn )
        ->leftjoin('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
        ->select(['siswa.*', 'jurusan.jurusan as nama_jurusan'])
        ->get();
        $output1 = '<label></label>';
        $output2 = '<label></label>';
        $output3 = '<label></label>';
        $output4 = '<label></label>';
        $output5 = '<label></label>';
        $output6 = '<label></label>';
        $output7 = '<label></label>';
        $output8 = '<label></label>';
        $output9 = '<label></label>';
        foreach($siswa as $row)
        {
            $output1 = '<label><img src="'.$row->foto.'" alt="Foto" height="100" width="100"> </label>';
            $output2 = '<label>Nama : '.$row->nama_lengkap.'</label>';
            $output3 = '<label>NIS : '.$nisn.'</label>';
            $output4 = '<label>Jurusan : '.$row->nama_jurusan.'</label>';
            $output5 = '<label>JK : '.$row->jenis_kelamin.'</label>';
            $output6 = '<label>Rombel : '.$row->rombel.'</label>';
            $output7 = '<label>Tempat Lahir : '.$row->tempat_lahir.'</label>';
            $output8 = '<label>Tanggal Lahir : '.$row->tanggal_lahir.'</label>';
            $output9 = '<label>Ortu/Wali : '.$row->ortu_wali.'</label>';
        }
            echo $output1."<br>";
            echo $output2."<br>";
            echo $output3."<br>";
            echo $output4."<br>";
            echo $output5."<br>";
            echo $output6."<br>";
            echo $output7."<br>";
            echo $output8."<br>";
            echo $output9."<br>";
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

        if($request->ajax())
        {

            $rules = array(
                'kelas.*'  => 'required',
                'siswa.*'  => 'required',
                'pelanggaran.*'  => 'required',
                'nama_petugas'  => 'required',
                'guru_id'  => 'required',
                'kehadiran_id'  => 'required'
                );
                $error = Validator::make($request->all(), $rules);
                if($error->fails())
                {
                    return response()->json([
                    'error'  => $error->errors()->all()
                    ]);
                }

            $pelanggaran = new Pelanggaran;
            $pelanggaran->guru_id = $request->guru_id;
            $pelanggaran->kehadiran_id = $request->kehadiran_id;
            $pelanggaran->nama_petugas = $request->nama_petugas;
            $pelanggaran->save();
            if($pelanggaran->save()){
                $kelas = $request->kelas;
                $siswa = $request->siswa;
                
                $pelanggarans = $request->pelanggaran;
                $set = Settings::all();
                $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
                for($count = 0; $count < count($siswa); $count++)
                {
                    $data = array(
                    'pelanggaran_id' => $pelanggaran->id,
                    'nis'  =>  str_pad($siswa[$count], 10, "0", STR_PAD_LEFT),
                    'jenis_pelanggaran_id'  => $pelanggarans[$count],
                    'tahun_ajaran_id'  => $ta[0]->id,
                    );
                    $insert_data[] = $data; 
                }   
                $save = PelanggaranDetail::insert($insert_data);
                // $k = new Konseling;
                if($save){
                   $k = PelanggaranDetail::where('pelanggaran_id', $pelanggaran->id )->get();
                   // return $k;
                   for($count = 0; $count < count($k); $count++)
                   {
                       $datas = array(
                       'pelanggaran_detail_id' => $k[$count]->id
                       );
                       $insert_data_kon[] = $datas; 
                   }
                   Konseling::insert($insert_data_kon);
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
        ->WHERE('pelanggaran_detail.id','=',$id)
        ->select(['pelanggaran_detail.*', 'pelanggaran.guru_id', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
        ->orderBy('pelanggaran_detail.id', 'desc')
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
        ->WHERE('pelanggaran_detail.id','=',$id)
        ->select(['pelanggaran_detail.*', 'pelanggaran.guru_id', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran','kehadiran.kode_kehadiran', 'siswa.*', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
        ->orderBy('pelanggaran_detail.id', 'desc')
        ->get();

        $logPelanggaran = DB::table('pelanggaran_log')
        ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'pelanggaran_log.pelanggaran_detail_id')
        ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
        ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_log.jenis_pelanggaran_id')
        ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
        ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
        ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran_log.kehadiran_id')
        ->WHERE('pelanggaran_log.pelanggaran_detail_id','=',$id)
        ->WHERE('pelanggaran_log.ajukan','=','Diajukan')
        ->select(['pelanggaran_log.*', 'pelanggaran_detail.pelanggaran_id',  'pelanggaran_detail.nis', 'jenis_pelanggaran.jenis_pelanggaran','kehadiran.kode_kehadiran', 'siswa.*', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
        ->orderBy('pelanggaran_detail.id', 'desc')
        ->get();

        // return count($logPelanggaran);

        $jpelanggaran = DB::table('jenis_pelanggaran')->get();
        $kelas = DB::table('kelas')->get();
        $guru = DB::table('guru')->get();
        $kehadiran = DB::table('kehadiran')->get();

        $dataPelanggaran = $pelanggaran;

        return view('ppiket.dpiket.edit', compact('pelanggaran', 'jpelanggaran', 'kelas', 'kehadiran', 'guru', 'dataPelanggaran', 'logPelanggaran'));
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
            $set = Settings::all();
            $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();

            $pDetail = PelanggaranDetail::findOrFail($id);
            $pLog = new PelanggaranLog;

            $pelanggaran_id = $request->id_pelanggaran;
            $pelanggaran = Pelanggaran::findOrFail($pelanggaran_id);

            $pLog->pelanggaran_detail_id = $pDetail->id;
            $pLog->jenis_pelanggaran_id = $request->pelanggaran;
            $pLog->tahun_ajaran_id = $ta[0]->id; 
            $pLog->ajukan = "Diajukan";
            $pLog->guru_id = $request->guru_id;
            $pLog->kehadiran_id = $request->kehadiran_id;
            $pLog->nama_petugas = $request->nama_petugas;
            
            $pDetail->ajukan = "Diajukan";

            if($pLog->save() && $pDetail->update()){
                    Session::flash('success', 'Data berhasil diubah');
                return redirect()->route('ppiket.dpiket.index');
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
        if (! Guru::destroy($id)) return redirect()->back();
        return redirect()->route('admin.guru.index');
    }
 
    public function dataTable()
    { 
        $set = Settings::all();
        $ta = TahunAjaran::where( 'tahun_awal', $set[0]->tahun_aktif )->get();
        if(Auth::user()->role == 'Petugas Piket Teknik Komputer Jaringan'){
            $jurusan = "JRTKJ"; 
        }elseif(Auth::user()->role == 'Petugas Piket Teknik Audio Video'){
            $jurusan = "JRAV"; 
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Kelistrikan'){
            $jurusan = "JRTITL"; 
        }elseif(Auth::user()['role'] == 'Petugas Piket Multimedia'){
            $jurusan = "JRMM"; 
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Pemesinan'){
            $jurusan = "JRTP"; 
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Kendaraan'){
            $jurusan = "JRKR"; 
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Sepeda Motor'){
            $jurusan = "JRTBSM"; 
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Pendingin'){
            $jurusan = "JRTP"; 
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Design Pemodelan Dan Informasi Bangunan'){
            $jurusan = "JRDPIB"; 
        }elseif(Auth::user()['role'] == 'Petugas Piket Teknik Rekayasa Perangkat Lunak'){
            $jurusan = "JRRPL"; 
        }
        $pelanggaran = DB::table('pelanggaran_detail')
        ->leftjoin('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
        ->leftjoin('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
        ->leftjoin('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
        ->leftjoin('guru', 'guru.id', '=', 'pelanggaran.guru_id')
        ->leftjoin('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
        ->select(['pelanggaran_detail.*', 'pelanggaran.guru_id', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
        ->where('pelanggaran_detail.tahun_ajaran_id','=',$ta[0]->id)
        ->where('siswa.jurusan','=',$jurusan)
        ->get();

        return DataTables::of($pelanggaran)
            ->addColumn('status_ajukan', function ($pelanggaran) {
                // return $pelanggaran->ajukan == "Diproses" ? '<span class="text-danger">Menunggu</span>' : '-';
                return $pelanggaran->ajukan;
            })
            ->addColumn('action', function ($pelanggaran) {
                return view('layouts.ppiket.partials.pelanggaran._action', [
                    'model' => $pelanggaran,
                    'show_url' => route('ppiket.dpiket.show', $pelanggaran->id),
                    'edit_url' => route('ppiket.dpiket.edit', $pelanggaran->id),
                    'delete_url' => route('ppiket.dpiket.destroy', $pelanggaran->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status_ajukan'])
            ->make(true);
    }
}
