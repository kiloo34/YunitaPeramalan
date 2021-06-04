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
        $produksi = \DB::table('produksi')->get();
        // dd($kecamatan);
        return view('mantri.peramalan.produksi', [
            'title' => 'Peramalan Produksi',
            'subtitle' => '',
            'active' => 'forePro',
            'kecamatan' => $kecamatan,
            'produksi' => $produksi
        ]);
    }

    public function prosesProduksi(Request $request, Kecamatan $kecamatan)
    {
        // dd($kecamatan);
        $fungsi = new Fungsi;
        $x1 = $fungsi->getX1($kecamatan->id); // Luas Panen
        $x2 = $fungsi->getX2($kecamatan->id); // Curah hujan
        $y = $fungsi->getY($kecamatan->id); // Produksi
        // dd($x1, $x2, $y);
        $val = new ForecastProduksi($x1, $x2, $y, $request->luas_panen, $request->curah_hujan);
        // dd($val);

        $periode = \DB::table('periode')
            ->orderBy('tahun', 'asc')
            ->orderBy('periode', 'asc')
            ->limit(20)
            ->get();

        foreach ($periode as $p) {
            $data = \DB::table('produksi')
                ->join('periode', 'periode.id', '=', 'produksi.periode_id')
                ->where('kecamatan_id', $kecamatan->id)
                ->where([
                    ['periode.periode', $p->periode],
                    ['periode.tahun', $p->tahun]
                ])
                ->select('produksi.*', 'periode.periode', 'periode.tahun')
                ->orderBy('tahun', 'asc')
                ->orderBy('periode', 'asc')
                ->first();
            if ($data) {
                $chart['label'][] = $p->tahun . ' T.' . $p->periode;
                $chart['data'][] = (int) $data->produksi;
            }
        }

        for ($i = 0; $i < count($val->res); $i++) {
            $chart['ramal'][] = (int) $val->res[$i];
        }
        dd($chart, $val->res);

        return view('mantri.peramalan.hasilProduksi', [
            'title' => 'produksi',
            'subtitle' => 'hasil',
            'active' => 'forePro',
            'kecamatan' => $kecamatan,
            'chart' => $chart,
            'hasil' => $val
        ]);
    }

    public function permintaan()
    {

        // $kecamatan = null;

        return view('mantri.peramalan.permintaan', [
            'title' => 'Peramalan Permintaan',
            'subtitle' => '',
            'active' => 'forePer',
            // 'data' => $res
        ]);
    }

    public function prosesPermintaan(Kecamatan $kecamatan)
    {
        dd('masuk');
        return view();
    }
}
