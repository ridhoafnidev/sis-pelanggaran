<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Session;
use App\Siswa;
use App\Settings;
use App\Konseling;
use App\Pelanggaran;
use App\IzinGerbang;
use App\TahunAjaran;
use App\PelanggaranLog;
use App\PelanggaranDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapKehadiranGuruExport;
use App\Exports\RekapKehadiranGuruCustomExport;
use App\Exports\RekapPelanggaranSiswaCustomExport;


class WakasisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:Wakil Kepala Sekolah Kesiswaan');
    }

    public function index(Request $request)
    {
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        if(request()->ajax())
        {
            if(!empty($request->filter_ta))
            {
                $data = DB::table('konseling')
                ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
                ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'pelanggaran_detail.tahun_ajaran_id')
                ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
                ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id') 
                ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
                ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
                ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
                ->select(['konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'tahun_ajaran.tahun_ajaran', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jenis_pelanggaran.poin as poin', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nis', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
                ->where('pelanggaran_detail.tahun_ajaran_id', $request->filter_ta)
                ->groupBy('pelanggaran_detail.nis')
                ->get();
            }else{
                $data = DB::table('konseling')
                ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
                ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'pelanggaran_detail.tahun_ajaran_id')
                ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
                ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id') 
                ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
                ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
                ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
                ->select(['konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'tahun_ajaran.tahun_ajaran', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jenis_pelanggaran.poin as poin', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nis', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
                ->where('pelanggaran_detail.tahun_ajaran_id', $ta[0]->id)
                ->groupBy('pelanggaran_detail.nis')
                ->get();
                }
                return DataTables::of($data)
                ->addColumn('total', function ($data) {
                    $set = Settings::all();
                    $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
                    $pelanggarans = DB::table('konseling')
                    ->selectRaw('sum(jenis_pelanggaran.poin) as total')
                    ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
                    ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
                    ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
                    ->where('pelanggaran_detail.nis','=', $data->nis)
                    ->where('pelanggaran_detail.tahun_ajaran_id','=',$ta[0]->id)
                    ->groupBy('pelanggaran_detail.nis')
                    ->get();
                    return $pelanggarans[0]->total;
                })
                ->addColumn('action', function ($data) {
                    return view('wakasis.rsiswa._action', [ 
                        'model' => $data,
                        'show_url' => route('wakasis.wakasis.show.rsiswa', $data->id),
    
                    ]);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        
        return view('wakasis.index');
    }

    public function mulai_akumulasi_pelanggaran(Request $request)
    {
            $set = Settings::all();
            $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();

            $tahunAjaranSekarang = $ta[0]->tahun_awal;
            $idTahunAjaranSekarang = $ta[0]->id;

            $tahunAjaranTahunLalu = $tahunAjaranSekarang - 1;

            $taTahunLalu = TahunAjaran::where('tahun_awal', $tahunAjaranTahunLalu )->first();

            $idTaTahunLalu = $taTahunLalu->id;

            // return $idTaTahunLalu;

            $id_jenis_pelanggaran = [25, 27, 28, 29, 30];

            $pelanggaranAkumulasiTahunLalu =  PelanggaranDetail::where('status', 0)
                                            ->whereIn('jenis_pelanggaran_id', $id_jenis_pelanggaran)
                                            ->where('tahun_ajaran_id', $idTaTahunLalu)
                                            ->get();

            $idPelanggaranDetailTerakhir = PelanggaranDetail::max('id');

            if(count($pelanggaranAkumulasiTahunLalu) != 0){
                for($i = 0; $i < count($pelanggaranAkumulasiTahunLalu); $i++){  
                    $x = $i+1; 
                    $id = $idPelanggaranDetailTerakhir + $x;

                    $arrayPenambahanIdPelanggaranDetail = array('id' => $id);

                    $arrayIdPelanggaranDetail = array($pelanggaranAkumulasiTahunLalu[$i]->id);

                    $data = array(
                        'pelanggaran_id' => $pelanggaranAkumulasiTahunLalu[$i]->pelanggaran_id,
                        'nis'  => $pelanggaranAkumulasiTahunLalu[$i]->nis,
                        'jenis_pelanggaran_id'  =>  $pelanggaranAkumulasiTahunLalu[$i]->jenis_pelanggaran_id,
                        'tahun_ajaran_id'  => $idTahunAjaranSekarang,
                        );

                    $insert_data[] = $data;

                    $dataArrayPenambahanIdPelanggaranDetail[] = $arrayPenambahanIdPelanggaranDetail;

                    $dataArrayIdPelanggaranDetail[] = implode(',',$arrayIdPelanggaranDetail);

                    $pelanggaran_detail_update = PelanggaranDetail::where('id', $pelanggaranAkumulasiTahunLalu[$i]->id)->update(['status' => 1]);
                    }  
                    $intArray = array_map(
                        function($value) { return (int)$value; },
                        $dataArrayIdPelanggaranDetail
                    );
                    // return $intArray;
                    // exit;
                    $save = PelanggaranDetail::insert($insert_data);
                    if($save && $pelanggaran_detail_update){
                        for($j=0; $j < count($dataArrayPenambahanIdPelanggaranDetail); $j++){
                            $konseling = Konseling::whereIn('pelanggaran_detail_id', $intArray)->get();
                            //return $konseling;
                            $datas = array(
                                'pelanggaran_detail_id' => $dataArrayPenambahanIdPelanggaranDetail[$j]['id'],
                                'deskripsi_penanganan' => $konseling[$j]['deskripsi_penanganan'],
                                'hasil_konseling' => $konseling[$j]['hasil_konseling'],
                                'rekomendasi' => $konseling[$j]['rekomendasi'],
                                'konseler' => $konseling[$j]['konseler'],
                                'keterangan' => $konseling[$j]['keterangan']
                            );
                            $insert_data_kon[] = $datas; 
                        }

                        Konseling::insert($insert_data_kon);

                        Session::flash('berhasil', 'Akumulasi data pelanggaran berhasil');
                        return redirect()->route('wakasis.wakasis.apelanggaran');
                    }else{
                        Session::flash('gagal', 'Akumulasi data pelanggaran gagal');
                        return redirect()->route('wakasis.wakasis.apelanggaran');
                    }
            }else{
                Session::flash('kosong', 'Data pelanggaran tahun lalu tidak ada');
                return redirect()->route('wakasis.wakasis.apelanggaran');
            }
    }

    public function akumulasi_pelanggaran(Request $request)
    {
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        $idTahunAjaranSekarang = $ta[0]->id;
        $id_jenis_pelanggaran = [25, 27, 28, 29, 30];
        if(request()->ajax())
        {
            if(!empty($request->filter_ta))
            {
                $data = DB::table('pelanggaran_detail')
                ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'pelanggaran_detail.tahun_ajaran_id')
                ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
                ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id') 
                ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
                ->join('notif_pelanggaran', 'notif_pelanggaran.nis', '=', 'siswa.nis')
                ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
                ->join('konseling', 'konseling.pelanggaran_detail_id', '=', 'pelanggaran_detail.id')
                ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
                ->select([ 'pelanggaran_detail.*', 'notif_pelanggaran.total_poin', 'konseling.keterangan', 'tahun_ajaran.tahun_ajaran', 'pelanggaran.guru_id', 'jenis_pelanggaran.poin as poin', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nis', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
                ->whereIn('pelanggaran_detail.jenis_pelanggaran_id', $id_jenis_pelanggaran)
                ->where('pelanggaran_detail.tahun_ajaran_id', $request->filter_ta)
                ->get();
            }else{
                 $data = DB::table('pelanggaran_detail')
                 ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'pelanggaran_detail.tahun_ajaran_id')
                ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
                ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id') 
                ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
                ->join('notif_pelanggaran', 'notif_pelanggaran.nis', '=', 'siswa.nis')
                ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
                ->join('konseling', 'konseling.pelanggaran_detail_id', '=', 'pelanggaran_detail.id')
                ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
                ->select([ 'pelanggaran_detail.*', 'notif_pelanggaran.total_poin', 'konseling.keterangan', 'tahun_ajaran.tahun_ajaran', 'pelanggaran.guru_id', 'jenis_pelanggaran.poin as poin', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nis', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
                ->whereIn('pelanggaran_detail.jenis_pelanggaran_id', $id_jenis_pelanggaran)
                ->get();

                }
                return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('wakasis.rsiswa._action', [ 
                        'model' => $data,
                        'show_url' => route('wakasis.wakasis.show.rsiswa', $data->id),
    
                    ]);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
              

        }

        $ta = TahunAjaran::all(['id', 'tahun_ajaran']);
        return view('wakasis.akumulasi_pelanggaran.index', compact('ta') );
    }

    public function create()
    {
        //
        return view('wakasis.create');
    }

    public function siswa()
    {
        return view('wakasis.index');
    }

    public function rekap_siswa()
    {
        $ta = TahunAjaran::all(['id', 'tahun_ajaran']);
        return view('wakasis.rsiswa.index', compact('ta'));
    }

    public function rekap_guru(Request $request)
    {
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        if(request()->ajax())
        {
            if(!empty($request->filter_ta))
            {
                $data = DB::table('izin')
                ->join('guru', 'guru.id', '=', 'izin.guru_id')
                ->join('izin_detail', 'izin_detail.izin_id', '=', 'izin.id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
                ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'izin.tahun_ajaran_id')
                ->select(['izin.*','tahun_ajaran.tahun_ajaran', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
                ->where('izin.tahun_ajaran_id','=', $request->filter_ta)
                ->groupBy('izin.guru_id') 
                ->get();

            }else{
                $data = DB::table('izin')
                ->join('guru', 'guru.id', '=', 'izin.guru_id')
                ->join('izin_detail', 'izin_detail.izin_id', '=', 'izin.id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
                ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'izin.tahun_ajaran_id')
                ->select(['izin.*','tahun_ajaran.tahun_ajaran', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
                ->where('izin.tahun_ajaran_id','=', $ta[0]->id)
                ->groupBy('izin.guru_id') 
                ->get();
                }
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('wakasis.rguru._action', [
                        'model' => $data,
                        'show_url' => route('wakasis.wakasis.show.rguru', $data->id),

                    ]);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $kehadiran_guru = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('izin_detail', 'izin_detail.izin_id', '=', 'izin.id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'izin.tahun_ajaran_id')
            ->select(['izin.*','tahun_ajaran.tahun_ajaran', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->where('izin.tahun_ajaran_id','=',$ta[0]->id)
            ->groupBy('izin.guru_id') 
            ->get();
        
        $ta = TahunAjaran::all(['id', 'tahun_ajaran']);
        return view('wakasis.rguru.index', compact('ta', 'kehadiran_guru'));
    }

    public function rekap_izin()
    {
        return view('wakasis.rizin.index');
    }

    public function lihat_semua_notif_pelanggaran()
    {
        return view('wakasis.notif_pelanggaran.index');
    }

    public function rekap_perubahan_data()
    {
        return view('wakasis.rperdata.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required|string|max:255',
            'nis' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'ortu_wali' => 'required',
            'rombel' => 'required',
            'jurusan' => 'required'

            /*    
            'tempat_lahir' => '',
            'tanggal_lahir' => '',
            'orang_tua' => '',
            'nipd' => '',
            'nik' => '',
            'agama' => '',
            'rt' => '',
            'rw' => '',
            'dusun' => '',
            'kelurahan' => '',
            'kecamatan' => '',
            'kode_pos' => '',
            'jenis_tinggal' => '',
            'alat_transportasi' => '',
            'telepon', 'email',
            'skhun' => '',
            'penerima_kps' => '',
            'nama_ayah' => '',
            'tahun_lahir_ayah' => '',
            'jenjang_pendidikan_ayah' => '',
            'pekerjaan_ayah' => '',
            'penghasilan_ayah' => '',
            'nik_ayah' => '',
            'nama_ibu' => '',
            'tahun_lahir_ibu' => '',
            'jenjang_pendidikan_ibu' => '',
            'pekerjaan_ibu' => '',
            'penghasilan_ibu' => '',
            'nik_ibu' => '',
            'nama_wali' => ''*/

        ]);

        /*

        $siswa = new Siswa;
        $siswa->nama_lengkap = $request->nama_lengkap;
        $siswa->nis = $request->nis;
        $siswa->alamat = $request->alamat;
        $siswa->no_hp = $request->no_hp;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->rombel = $request->rombel;
        $siswa->jurusan = $request->jurusan;
        $siswa->tempat_lahir = '';
        $siswa->tanggal_lahir = '';
        $siswa->foto='';
        $siswa->orang_tua = '';
        $siswa->nipd = '';
        $siswa->nik = '';
        $siswa->agama = '';
        $siswa->rt = '';
        $siswa->rw = '';
        $siswa->dusun = '';
        $siswa->kelurahan = '';
        $siswa->kecamatan = '';
        $siswa->kode_pos = '';
        $siswa->jenis_tinggal = '';
        $siswa->alat_transportasi = '';
        $siswa->telepon = '';
        $siswa->email = '';
        $siswa->skhun = '';
        $siswa->penerima_kps = '';
        $siswa->nama_ayah = '';
        $siswa->tahun_lahir_ayah = '';
        $siswa->jenjang_pendidikan_ayah = '';
        $siswa->pekerjaan_ayah = '';
        $siswa->penghasilan_ayah = '';
        $siswa->nik_ayah = '';
        $siswa->nama_ibu = '';
        $siswa->tahun_lahir_ibu = '';
        $siswa->jenjang_pendidikan_ibu = '';
        $siswa->pekerjaan_ibu = '';
        $siswa->penghasilan_ibu = '';
        $siswa->nik_ibu = '';
        $siswa->nama_wali = '';
*/
        $request['foto'] = $request->get('foto') ? $request->get('foto') : '/photos/user-icon.png';
        Siswa::create($request->all());
        return redirect()->route('wakasis.wakasis.siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$siswa = Siswa::find($id);
        $siswa = DB::table('siswa')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
            ->WHERE('siswa.nis', '=', $id)
            ->select(['siswa.*', 'jurusan.jurusan as jurusan'])
            ->get();
        return view('wakasis.show', compact('siswa'));
    }

    public function show_notif_pelanggaran($id)
    {

        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();

        $pelanggaran = DB::table('konseling')
            ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
            ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
            ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
            ->join('notif_pelanggaran', 'notif_pelanggaran.nis', '=', 'siswa.nis')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
            ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
            ->WHERE('pelanggaran_detail.nis', '=', $id)
            ->select(['notif_pelanggaran.total_poin', 'konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'jenis_pelanggaran.poin', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->get();

        $pelanggaran_semua = DB::table('konseling')
            ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
            ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
            ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
            ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
            ->WHERE('pelanggaran_detail.nis', '=', $pelanggaran[0]->nis)
            ->WHERE('pelanggaran_detail.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'jenis_pelanggaran.poin', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->get();
        $jpelanggaran = DB::table('jenis_pelanggaran')->get();
        $kelas = DB::table('kelas')->get();
        $guru = DB::table('guru')->get();
        $kehadiran = DB::table('kehadiran')->get();
        $dataPelanggaran = $pelanggaran; 
        $pelanggaranSemua = $pelanggaran_semua; 

        // return $pelanggaranSemua;

        return view('wakasis.notif_pelanggaran.edit',  compact('pelanggaranSemua', 'pelanggaran', 'jpelanggaran', 'kelas', 'kehadiran', 'guru', 'dataPelanggaran'));
    }

    public function show_rekap_siswa($id)
    {

        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();

        $pelanggaran = DB::table('konseling')
            ->leftjoin('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
            ->leftjoin('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
            ->leftjoin('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
            ->leftjoin('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
            ->leftjoin('notif_pelanggaran', 'siswa.nis', '=', 'notif_pelanggaran.nis')
            ->leftjoin('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
            ->leftjoin('guru', 'guru.id', '=', 'pelanggaran.guru_id')
            ->leftjoin('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
            ->WHERE('pelanggaran_detail.id', '=', $id)
            ->select(['notif_pelanggaran.total_poin', 'konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'jenis_pelanggaran.poin', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->get();

        $pelanggaran_semua = DB::table('konseling')
            ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
            ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
            ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
            ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
            ->WHERE('pelanggaran_detail.nis', '=', $pelanggaran[0]->nis)
            ->WHERE('pelanggaran_detail.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'jenis_pelanggaran.poin', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->get();
        $jpelanggaran = DB::table('jenis_pelanggaran')->get();
        $kelas = DB::table('kelas')->get();
        $guru = DB::table('guru')->get();
        $kehadiran = DB::table('kehadiran')->get();
        $dataPelanggaran = $pelanggaran; 
        $pelanggaranSemua = $pelanggaran_semua; 

        // return $pelanggaranSemua;

        return view('wakasis.rsiswa.edit',  compact('pelanggaranSemua', 'pelanggaran', 'jpelanggaran', 'kelas', 'kehadiran', 'guru', 'dataPelanggaran'));
    }

    public function show_rekap_guru($id)
    {
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        $kehadiran_guru = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('izin.id', '=', $id)
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $kehadiran_guru_semua = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $hadir = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.kehadiran_id', '=', 'K1')
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $thtk = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.kehadiran_id', '=', 'K2')
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $thdk = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.kehadiran_id', '=', 'K3')
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $th = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.kehadiran_id', '=', 'K4')
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $ckk = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.kehadiran_id', '=', 'K5')
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $data = $kehadiran_guru; 
        $kehadiran = $kehadiran_guru_semua;
        $count_hadir = count($hadir);
        $count_thtk = count($thtk);
        $count_thdk = count($thdk);
        $count_th = count($th);
        $count_ckk = count($ckk);
        return view('wakasis.rguru.edit',  compact('data', 'kehadiran', 'count_hadir', 'count_thtk', 'count_thdk', 'count_th', 'count_ckk'));
    }

    public function show_rekap_perubahan_data($id)
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

        return view('wakasis.rperdata.edit', compact('pelanggaran', 'jpelanggaran', 'kelas', 'kehadiran', 'guru', 'dataPelanggaran', 'logPelanggaran'));
    }

    // fungsi untuk menyetujui data perubahan
    public function update_rekap_perubahan_data(Request $request, $id)
    {
        $pelanggaran_id = $request->id_pelanggaran;

        // query cari tahun ajaran altif
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();

        // query cari data log pelanggaran dari data pelanggaran yang di ubah oleh petugas piket
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

        // query cari data pelanggaran detail sesuai id dari tabe; pelanggaran_detail
        $pDetail = PelanggaranDetail::findOrFail($id);

        // query cari data log pelanggaran sesuai dengan id di table pelanggaran_log
        $pLogDetail = PelanggaranLog::findOrFail($logPelanggaran[0]->id);

        // query cari data pelanggaran sesuai dengan id di tabel pelanggaran 
        $pelanggaran = Pelanggaran::findOrFail($pelanggaran_id);

        // update data log pelanggaran
        $pLogDetail->ajukan = "Diterima";
        
        // update data pelanggaran detail
        $pDetail->ajukan = "Diterima";
        $pDetail->jenis_pelanggaran_id = $logPelanggaran[0]->jenis_pelanggaran_id;

        // update data pelanggaran
        $pelanggaran->guru_id = $logPelanggaran[0]->guru_id;
        $pelanggaran->kehadiran_id = $logPelanggaran[0]->kehadiran_id;
        $pelanggaran->nama_petugas = $logPelanggaran[0]->nama_petugas;

        if($pLogDetail->update() && $pDetail->update() && $pelanggaran->update() ){
            Session::flash('success', 'Data berhasil disetujui');
            return redirect()->route('wakasis.wakasis.rperdata');
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('wakasis.edit', compact('siswa'));
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
        $nisn = str_pad($value, 10, "0", STR_PAD_LEFT);
        $dependent = $request->get('dependent');
        $siswa = Siswa::where('nis', $nisn)->get();
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

    public function update(Request $request, $nis)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required|string|max:255',
            'nis' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'jenis_kelamin' => 'required',
            'rombel' => 'required',
            'jurusan' => 'required',
            /* 'tempat_lahir' => '',
            'tanggal_l'tempat_lahir' => '',
            'tanggal_lahir' => '',
            'orang_tua' => '',
            'nipd' => '',
            'nik' => '',
            'agama' => '',
            'rt' => '',
            'rw' => '',
            'dusun' => '',
            'kelurahan' => '',
            'kecamatan' => '',
            'kode_pos' => '',
            'jenis_tinggal' => '',
            'alat_transportasi' => '',
            'telepon', 'email',
            'skhun' => '',
            'penerima_kps' => '',
            'nama_ayah' => '',
            'tahun_lahir_ayah' => '',
            'jenjang_pendidikan_ayah' => '',
            'pekerjaan_ayah' => '',
            'penghasilan_ayah' => '',
            'nik_ayah' => '',
            'nama_ibu' => '',
            'tahun_lahir_ibu' => '',
            'jenjang_pendidikan_ibu' => '',
            'pekerjaan_ibu' => '',
            'penghasilan_ibu' => '',
            'nik_ibu' => '',
            'nama_wali' => ''ahir' => '',
            'orang_tua' => '',
            'nipd' => '',
            'nik' => '',
            'agama' => '',
            'rt' => '',
            'rw' => '',
            'dusun' => '',
            'kelurahan' => '',
            'kecamatan' => '',
            'kode_pos' => '',
            'jenis_tinggal' => '',
            'alat_transportasi' => '',
            'telepon', 'email',
            'skhun' => '',
            'penerima_kps' => '',
            'nama_ayah' => '',
            'tahun_lahir_ayah' => '',
            'jenjang_pendidikan_ayah' => '',
            'pekerjaan_ayah' => '',
            'penghasilan_ayah' => '',
            'nik_ayah' => '',
            'nama_ibu' => '',
            'tahun_lahir_ibu' => '',
            'jenjang_pendidikan_ibu' => '',
            'pekerjaan_ibu' => '',
            'penghasilan_ibu' => '',
            'nik_ibu' => '',
            'nama_wali' => ''*/
        ]);

        $siswa = Siswa::findOrFail($nis);

        $request['foto'] = $request->get('foto') ? $request->get('foto') : '/images/user-icon.png';

        $siswa->update($request->all());

        return redirect()->route('wakasis.wakasis.siswa');
    }

    public function destroy($id)
    {
        //
        if (!Siswa::destroy($id)) return redirect()->back();
        return redirect()->route('wakasis.wakasis.siswa');
    }

    public function dataTableRekapSiswa(Request $request)
    {
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        if(request()->ajax())
        {
            if(!empty($request->filter_ta))
            {
                $pelanggaran_siswa = DB::table('konseling')
                ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
                ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'pelanggaran_detail.tahun_ajaran_id')
                ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
                ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id') 
                ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
                ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
                ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
                ->selectRaw(['sum(jenis_pelanggaran.poin) as total', 'konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jenis_pelanggaran.poin as poin', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nis', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
                ->select(['konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'tahun_ajaran.tahun_ajaran', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jenis_pelanggaran.poin as poin', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nis', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
                ->where('pelanggaran_detail.tahun_ajaran_id', $request->filter_ta)
                ->groupBy('pelanggaran_detail.nis')
                ->get();
            }else{
                $pelanggaran_siswa = DB::table('konseling')
                ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
                ->join('tahun_ajaran', 'tahun_ajaran.id', '=', 'pelanggaran_detail.tahun_ajaran_id')
                ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
                ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id') 
                ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
                ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
                ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
                ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
                ->where('pelanggaran_detail.tahun_ajaran_id','=',$ta[0]->id)
                ->select(['konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'tahun_ajaran.tahun_ajaran', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jenis_pelanggaran.poin as poin', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nis', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
                ->groupBy('pelanggaran_detail.nis')
                ->get();
                }
                return DataTables::of($pelanggaran_siswa)
                ->addColumn('total', function ($pelanggaran_siswa) {
                    $pelanggarans = DB::table('konseling')
                    ->selectRaw('sum(jenis_pelanggaran.poin) as total')
                    ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
                    ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
                    ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
                    ->where('pelanggaran_detail.nis','=', $pelanggaran_siswa->nis)
                    ->where('pelanggaran_detail.tahun_ajaran_id','=',$ta[0]->id)
                    ->groupBy('pelanggaran_detail.nis')
                    ->get();
                    return $pelanggarans[0]->total;
                })
                ->addColumn('action', function ($pelanggaran_siswa) {
                    return view('wakasis.rsiswa._action', [ 
                        'model' => $pelanggaran_siswa,
                        'show_url' => route('wakasis.wakasis.show.rsiswa', $pelanggaran_siswa->id),
    
                    ]);
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

     
    }

    public function dataTableNotifPelanggaran()
    {
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        $notif_pelanggaran = DB::table('notif_pelanggaran')
            ->join('siswa', 'siswa.nis', '=', 'notif_pelanggaran.nis')
            ->select(['notif_pelanggaran.*','siswa.nama_lengkap','siswa.rombel'])
            ->where('notif_pelanggaran.tahun_ajaran_id','=',$ta[0]->id)
            ->orderBy('siswa.nama_lengkap', 'asc')
            ->get();
        return DataTables::of($notif_pelanggaran)
            ->addColumn('action', function ($notif_pelanggaran) {
                return view('wakasis.rguru._action', [
                    'model' => $notif_pelanggaran,
                    'show_url' => route('wakasis.wakasis.show.npelanggaran', $notif_pelanggaran->nis),

                ]);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function dataTableRekapGuru()
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
        return DataTables::of($kehadiran_guru)
            ->addColumn('action', function ($kehadiran) {
                return view('wakasis.rguru._action', [
                    'model' => $kehadiran,
                    'show_url' => route('wakasis.wakasis.show.rguru', $kehadiran->id),

                ]);
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function dataTableRekapIzin()
    {
        $izins = DB::table('izin_gerbang')
            ->join('izin_detail', 'izin_gerbang.izin_detail_id', '=', 'izin_detail.id')
            ->join('siswa', 'izin_detail.nis', '=', 'siswa.nis')
            ->select([
                'izin_gerbang.id',
                'siswa.nama_lengkap as siswa',
                'izin_detail.keterangan_izin as keterangan',
                'izin_gerbang.masuk as masuk',
                'izin_gerbang.keluar as keluar',
                'izin_gerbang.datetime as jam'
            ])
            ->get();
        return DataTables::of($izins)
            //->rawColumns(['action'])
            ->make(true);
    }

    public function dataTableSiswa()
    {
        $data_siswa = DB::table('siswa')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
            ->select(['siswa.*', 'jurusan.jurusan as jurusan'])
            ->get();
        return DataTables::of($data_siswa)
            ->addIndexColumn()
            ->addColumn('action', function ($siswa) {
                return view('wakasis._action', [
                    'model' => $siswa,
                    'show_url' => route('wakasis.wakasis.show', $siswa->nis),
                    'edit_url' => route('wakasis.wakasis.edit', $siswa->nis),
                    'delete_url' => route('wakasis.wakasis.destroy', $siswa->nis),
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dataTablePerubahanData()
    {
        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        $perubahan_data = DB::table('pelanggaran_detail')
            ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
            ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
            ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
            ->select(['pelanggaran_detail.*', 'pelanggaran.guru_id', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->where('pelanggaran_detail.ajukan','=',"Diajukan")
            ->where('pelanggaran_detail.tahun_ajaran_id','=',$ta[0]->id)
            ->get();
        return DataTables::of($perubahan_data)
            ->addColumn('action', function ($perubahan_data) {
                return view('wakasis.rguru._action', [
                    'model' => $perubahan_data,
                    'show_url' => route('wakasis.wakasis.show.rperdata', $perubahan_data->id),

                ]);
            })
            ->rawColumns(['action', 'status_ajukan'])
            ->addIndexColumn()
            ->make(true);
    }

    public function cetak_rekap_siswa($id)
    {
        if( $id == 0 ){
            $export = (new RekapPelanggaranSiswaCustomExport)->download('REKAP DATA PELANGGARAN SISWA.xlsx');
        }else{
            $export = (new RekapPelanggaranSiswaExport($id))->download('REKAP DATA PELANGGARAN SISWA.xlsx');
        }
        return $export;
    } 

    public function cetak_rekap_guru($id)
    {
        if( $id == 0 ){
            $export = (new RekapKehadiranGuruCustomExport)->download('REKAP DATA KEHADIRAN GURU.xlsx');
        }else{
            $export = (new RekapKehadiranGuruExport($id))->download('REKAP DATA KEHADIRAN GURU.xlsx');
        }
        return $export;
    } 

    public function cetak_rekap_guru_detail($id)
    {

        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();
        $kehadiran_guru = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('izin.id', '=', $id)
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $kehadiran_guru_semua = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $hadir = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.kehadiran_id', '=', 'K1')
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $thtk = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.kehadiran_id', '=', 'K2')
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $thdk = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.kehadiran_id', '=', 'K3')
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $th = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.kehadiran_id', '=', 'K4')
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $ckk = DB::table('izin')
            ->join('guru', 'guru.id', '=', 'izin.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'izin.kehadiran_id')
            ->WHERE('guru.id', '=', $kehadiran_guru[0]->guru_id)
            ->WHERE('izin.kehadiran_id', '=', 'K5')
            ->WHERE('izin.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['izin.*', 'guru.nama_lengkap as guru', 'kehadiran.jenis_kehadiran as kehadiran', 'izin.nama_petugas as petugas'])
            ->get();

        $data = $kehadiran_guru;
        $kehadiran = $kehadiran_guru_semua;
        $count_hadir = count($hadir);
        $count_thtk = count($thtk);
        $count_thdk = count($thdk);
        $count_th = count($th);
        $count_ckk = count($ckk);

        # return view('wakasis.rguru.edit',  compact('data'));
        $pdf = PDF::loadView('wakasis.rguru.pdf_guru_detail', compact('data', 'kehadiran', 'count_hadir', 'count_thtk', 'count_thdk', 'count_th', 'count_ckk'));

        // Download
        //  return $pdf->download('rekap-pelanggaran-siswa');

        // Preview
        return $pdf->stream();
    }

    public function cetak_rekap_siswa_detail($id)
    {

        $set = Settings::all();
        $ta = TahunAjaran::where('tahun_awal', $set[0]->tahun_aktif )->get();

        $pelanggaran = DB::table('konseling')
            ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
            ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
            ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
            ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
            ->WHERE('pelanggaran_detail.id', '=', $id)
            ->select(['konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'jenis_pelanggaran.poin', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->get();

        $pelanggaran_semua = DB::table('konseling')
            ->join('pelanggaran_detail', 'pelanggaran_detail.id', '=', 'konseling.pelanggaran_detail_id')
            ->join('pelanggaran', 'pelanggaran.id', '=', 'pelanggaran_detail.pelanggaran_id')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id', '=', 'pelanggaran_detail.jenis_pelanggaran_id')
            ->join('siswa', 'siswa.nis', '=', 'pelanggaran_detail.nis')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
            ->join('guru', 'guru.id', '=', 'pelanggaran.guru_id')
            ->join('kehadiran', 'kehadiran.kode_kehadiran', '=', 'pelanggaran.kehadiran_id')
            ->WHERE('pelanggaran_detail.nis', '=', $pelanggaran[0]->nis)
            ->WHERE('pelanggaran_detail.tahun_ajaran_id', '=', $ta[0]->id)
            ->select(['konseling.*', 'pelanggaran_detail.*', 'konseling.id as id_konseling', 'konseling.keterangan as status', 'pelanggaran.guru_id', 'jurusan.jurusan', 'pelanggaran.kehadiran_id', 'pelanggaran.nama_petugas', 'jenis_pelanggaran.jenis_pelanggaran', 'jenis_pelanggaran.poin', 'siswa.nama_lengkap as nama_siswa', 'siswa.rombel', 'guru.nama_lengkap as nama_guru', 'kehadiran.jenis_kehadiran'])
            ->get();
        
        $jpelanggaran = DB::table('jenis_pelanggaran')->get();
        $kelas = DB::table('kelas')->get();
        $guru = DB::table('guru')->get();
        $kehadiran = DB::table('kehadiran')->get();
        $dataPelanggaran = $pelanggaran; 
        $pelanggaranSemua = $pelanggaran_semua; 

        $pdf = PDF::loadView('wakasis.rsiswa.pdf_siswa_detail', compact('pelanggaranSemua', 'pelanggaran', 'jpelanggaran', 'kelas', 'kehadiran', 'guru', 'dataPelanggaran'));

        // Preview
        return $pdf->stream();
    }

    
}