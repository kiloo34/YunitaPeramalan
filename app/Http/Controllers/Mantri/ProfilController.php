<?php

namespace App\Http\Controllers\Mantri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('mantri.profil.index', [
            'title' => 'profil',
            'subtitle' => '',
            'active' => 'profil'
        ]);
    }
}
