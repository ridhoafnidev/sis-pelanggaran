<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\IzinGerbang;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PetugasGerbangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:Petugas Gerbang');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = Validator::make($request->all(), [
            'masuk' => 'required',
            'keluar' => 'required',
            'tidak_masuk' => 'required'
        ]);
        $error_list = array();
        $success_output='';
        if ($validation->fails()) {
            foreach ($validation->messages()->getMessages() as $field_name  => $messages) {
                $error[] = $messages;
            }
        } else {

            if ($request->get('button_action') == 'update') {
                $izin = IzinGerbang::findOrFail($request->get('id'));
                $izin->masuk = $request->get('masuk');
                $izin->keluar = $request->get('keluar');
                $izin->tidak_masuk = $request->get('tidak_masuk');
                $izin->save();
                $success_output = '<div class="alert alert-success">Berhasil Diubah</div>';
            }
        }

        $output = array(
            'error' => $error_list,
            'success' => $success_output
        );

        echo json_encode($output);
        
        return redirect()->route('pgerbang.izin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $izin = IzinGerbang::findOrFail($id);
        return view('pgerbang.show', compact('izin'));
    }


    public function izin()
    {
        # code...
        return view('pgerbang.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $id = $request->input('id');
        $izin = IzinGerbang::findOrFail($id);
        $out = array(
            'masuk' => $izin->masuk,
            'keluar' => $izin->keluar,
            'tidak_masuk' => $izin->tidak_masuk
        );

        echo json_encode($out);

        //return view('pgerbang.index', compact('izin'));
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
        //
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function dataTable()
    {
        $izins = IzinGerbang::select(
            'izin_gerbang.id',
            'siswa.nama_lengkap as siswa',
            'izin_detail.keterangan_izin as keterangan',
            'izin_gerbang.masuk as masuk',
            'izin_gerbang.keluar as keluar',
            'izin_gerbang.tidak_masuk as tidak_masuk',
            'izin_gerbang.datetime as jam'
        )
            ->join('izin_detail', 'izin_gerbang.izin_detail_id', '=', 'izin_detail.id')
            ->join('siswa', 'izin_detail.nis', '=', 'siswa.nis')
            ->get();
        return DataTables::of($izins)

            ->addColumn('action', function ($izin) {
                /*return view('pgerbang.partials._action', [
                    'model' => $izin,
                    // 'show_url' => route('pgerbang.pgerbang.show', $izin->id),
                    'edit_url' => route('pgerbang.pgerbang.update', $izin->id),
                    //'delete_url' => route('pgerbang.pgerbang.destroy', $users->id),
                ]);*/
                return '<a href="#" class="btn btn-sm btn-outline-info edit" style="padding-bottom: 0px; padding-top: 0px;"
                id="' . $izin->id . '"><span class="btn-label btn-label-right"><i class="fa fa-edit"></i></span>Edit Keterangan Siswa
                </a>';
            })
            ->rawColumns(['pgerbang', 'action'])
            ->make(true);
    }
}
