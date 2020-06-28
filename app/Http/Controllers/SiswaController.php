<?php

namespace App\Http\Controllers;

use DB;
use App\Guru;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Imports\SiswaImport;
use Excel;
class SiswaController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:Administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.siswa.index');
    }

    public function import()
    {
        return view('admin.siswa.import');
    }

    public function mulai_import(Request $request)
    {
        //VALIDASI
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file'); //GET FILE
            Excel::import(new SiswaImport, $file); //IMPORT FILE 
            return redirect()->back()->with(['success' => 'Upload Berhasi;']);
        }  
        return redirect()->back()->with(['error' => 'Pilih dulu ya']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.siswa.create');
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
            'email' => 'required|string|min:3'
        ]);

        // $request['slug'] = str_slug($request->get('title'), '-');

        Guru::create($request->all());

        return redirect()->route('admin.siswa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.siswa.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
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

        $guru = Guru::findOrFail($id);
        $guru->update($request->all());

        return redirect()->route('admin.guru.index');

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

    public function dataTableSiswa()
    {
        $data_siswa = DB::table('siswa')
            ->join('jurusan', 'jurusan.id', '=', 'siswa.jurusan')
            ->select(['siswa.*', 'jurusan.jurusan as jurusan'])
            ->get();
        return DataTables::of($data_siswa)
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
}
