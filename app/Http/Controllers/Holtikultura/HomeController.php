<?php

namespace App\Http\Controllers\Holtikultura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('holtikultura.dashboard', [
            'title' => 'dashboard',
            'subtitle' => '',
            'active' => 'dashboard'
        ]);
    }
}
