<?php

namespace App\Http\Controllers\Mantri;

use App\Http\Controllers\Controller;
use App\Helpers\ForecastProduksi;
// use App\Helpers\ForcastPermintaan;
use App\Helpers\Fungsi;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class PeramalanController extends Controller
{
    // public function __construct($x = null, $y = null)
    // {
    //     if (!is_null($x) && !is_null($y)) {
    //         $this->x = $x;
    //         $this->y = $y;
    //         $this->compute();
    //     }
    // }

    public function produksi(Kecamatan $kecamatan)
    {
        $fungsi = new Fungsi;
        $x1 = $fungsi->getX1($kecamatan->id);
        $x2 = $fungsi->getX2($kecamatan->id);
        $y = $fungsi->getY($kecamatan->id);
        // dd($x1, $x2, $y);

        $val = new ForecastProduksi($x1, $x2, $y);
        // dd($val->res);
        return view('mantri.peramalan.produksi', [
            'title' => 'produksi',
            'subtitle' => 'peramalan',
            'active' => 'produksi',
            'data' => $val
        ]);
    }

    public function permintaan()
    {
        $x = \DB::table('users');
        $y = \DB::table('users');
        // $res = new RegresiLinear();
        return view('mantri.peramalan.permintaan', [
            'title' => 'produksi',
            'subtitle' => 'peramalan',
            'active' => 'produksi',
            'data' => $res
        ]);
    }
}
