<?php

namespace App\Http\Controllers;

use App\JenisPelanggaran;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class JenisPelanggaranController extends Controller
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
        return view('admin.jpelanggaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jpelanggaran.create');
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
            'email' => 'required|string|min:3|unique:email'
        ]);
        // $request['slug'] = str_slug($request->get('title'), '-');
        JenisPelanggaran::create($request->all());

        return redirect()->route('admin.jpelanggaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jpelanggaran = JenisPelanggaran::findOrFail($id);
        return view('admin.jpelanggaran.show', compact('jpelanggarans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jpelanggaran = JenisPelanggaran::findOrFail($id);
        return view('admin.jpelanggaran.edit', compact('jpelanggaran'));
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

        $jpelanggaran = JenisPelanggaran::findOrFail($id);
        $jpelanggaran->update($request->all());

        return redirect()->route('admin.jpelanggaran.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! JenisPelanggaran::destroy($id)) return redirect()->back();
        return redirect()->route('admin.jpelanggaran.index');
    }

    public function dataTable()
    {
        $jpelanggaran = JenisPelanggaran::query();

        return DataTables::of($guru)
            ->addColumn('action', function ($guru) {
                return view('layouts.admin.partials._action', [
                    'model' => $jpelanggaran,
                    'show_url' => route('admin.jpelanggaran.show', $jpelanggaran->id),
                    'edit_url' => route('admin.jpelanggaran.edit', $jpelanggaran->id),
                    'delete_url' => route('admin.jpelanggaran.destroy', $jpelanggaran->id)
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
