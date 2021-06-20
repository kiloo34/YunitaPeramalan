<?php

namespace App\Http\Controllers\Holtikultura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function index()
    {
        return view('holtikultura.produksi.index', [
            'title' => 'produksi',
            'subtitle' => '',
            'active' => 'produksi'
        ]);
    }
}
