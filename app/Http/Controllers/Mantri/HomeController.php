<?php

namespace App\Http\Controllers\Mantri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $periode = \DB::table('periode')->get();
        $kecamatan = \DB::table('kecamatan')
            ->orderBy('nama', 'asc')
            ->get();
        // dd('masuk controller');
        return view('mantri.dashboard', [
            'title' => 'dashboard',
            'subtitle' => '',
            'active' => 'dashboard',
            'kecamatan' => $kecamatan,
            'periode' => $periode
        ]);
    }
}
