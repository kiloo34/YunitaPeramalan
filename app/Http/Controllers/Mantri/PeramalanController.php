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

    public function produksi()
    {
        $kecamatan = \DB::table('kecamatan')->get();
        // $fungsi = new Fungsi;
        // $x1 = $fungsi->getX1($kecamatan->id);
        // $x2 = $fungsi->getX2($kecamatan->id);
        // $y = $fungsi->getY($kecamatan->id);

        // $kecamatan = null;
        // $val = new ForecastProduksi($x1, $x2, $y);
        // dd($val->res);
        // dd($kecamatan);
        return view('mantri.peramalan.produksi', [
            'title' => 'Peramalan Produksi',
            'subtitle' => '',
            'active' => 'forePro',
            'kecamatan' => $kecamatan
        ]);
    }

    public function permintaan()
    {

        $kecamatan = null;

        return view('mantri.peramalan.permintaan', [
            'title' => 'Peramalan Permintaan',
            'subtitle' => '',
            'active' => 'forePer',
            // 'data' => $res
        ]);
    }
}
