<?php

namespace App\Http\Controllers\Holtikultura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('holtikulturia.profil.index', [
            'title' => 'profil',
            'subtitle' => '',
            'active' => 'profil'
        ]);
    }
}
