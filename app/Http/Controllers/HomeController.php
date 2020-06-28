<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'Administrator') {
            return view('home.home');
        } elseif (Auth::user()->role == 'Petugas Piket') {
            return view('home.home-ppiket');
        } elseif (Auth::user()->role == 'Bimbingan Konseling') {
            return view('home.home-konseling');
        } elseif (Auth::user()->role == 'Petugas Gerbang') {
            return view('home.home-pgerbang');
        } elseif (Auth::user()->role == 'Wakil Kepala Sekolah Kesiswaan') {
            return view('home.home-wakasis');
        } else {
            return view('home.home-wakepsek');
        }
    }
}
