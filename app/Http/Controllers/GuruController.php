<?php

namespace App\Http\Controllers;

use App\Guru;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class GuruController extends Controller
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
        return view('admin.guru.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guru.create');
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

        return redirect()->route('admin.guru.index');
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
        return view('admin.guru.show', compact('guru'));
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

    public function dataTable()
    {
        $guru = Guru::query();

        return DataTables::of($guru)
            ->addColumn('action', function ($guru) {
                return view('layouts.admin.partials._action', [
                    'model' => $guru,
                    'show_url' => route('admin.guru.show', $guru->id),
                    'edit_url' => route('admin.guru.edit', $guru->id),
                    'delete_url' => route('admin.guru.destroy', $guru->id)
                ]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
