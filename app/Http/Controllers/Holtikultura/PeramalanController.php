<?php

namespace App\Http\Controllers\Holtikultura;

use App\Http\Controllers\Controller;
use App\Helpers\ForecastPermintaan;
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
        return view('holtikultura.peramalan.produksi', [
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

        $maxPeriode = $fungsi->getMaxPeriode();

        // dd($x1, $x2, $y, $maxPeriode);

        if ($x2 == 'dataproduksikurang') {
            return redirect()->route('forecast.production.index')->with('error_msg', 'Data Produksi ' . $kecamatan->nama . ' tidak lengkap, cek data Produksi ' . $kecamatan->nama);
        } elseif ($x2 == 'datacurahhujankurang') {
            return redirect()->route('forecast.production.index')->with('error_msg', 'Data Curah Hujan tidak lengkap, cek data curah hujan');
        } elseif ($x2 == 'dataTidakDitemukan') {
            return redirect()->route('forecast.production.index')->with('error_msg', 'Data Produksi ' . $kecamatan->nama . ' tidak ditemukan, cek data Produksi ' . $kecamatan->nama);
        } elseif ($x1 == false) {
            return redirect()->route('forecast.production.index')->with('error_msg', 'Data Produksi ' . $kecamatan->nama . ' tidak lengkap atau kosong, cek data Produksi ' . $kecamatan->nama);
        }

        $val = new ForecastProduksi($x1, $x2, $y, $request->luas_panen, $request->curah_hujan);

        if ($val->res == false) {
            return redirect()->route('forecast.production.index')->with('error_msg', 'Data Produksi ' . $kecamatan->nama . ' tidak lengkap atau kosong, cek data Produksi ' . $kecamatan->nama);
        }

        $periode = \DB::table('periode')
            ->orderBy('tahun', 'asc')
            ->orderBy('periode', 'asc')
            ->limit(20)
            ->get();

        // foreach ($periode as $p) {
        //     $data = \DB::table('produksi')
        //         ->join('periode', 'periode.id', '=', 'produksi.periode_id')
        //         ->where('kecamatan_id', $kecamatan->id)
        //         ->where([
        //             ['periode.periode', $p->periode],
        //             ['periode.tahun', $p->tahun]
        //         ])
        //         ->select('produksi.*', 'periode.periode', 'periode.tahun')
        //         ->orderBy('tahun', 'asc')
        //         ->orderBy('periode', 'asc')
        //         ->first();
        //     if ($data) {

        //         $chart['label'][] = $p->tahun . ' T.' . $p->periode;
        //         $chart['data'][] = (int) $data->produksi;
        //     }
        // }

        // for ($i = 0; $i < count($val->res); $i++) {
        //     $chart['ramal'][] = (int) $val->res[$i];
        //     if ($i == count($periode) && $maxPeriode == 4) {
        //         $chart['label'][$i] = $p->tahun + 1 . ' T.' . 1;
        //     } else {
        //         $chart['label'][$i] = $p->tahun + 1 . ' T.' . $maxPeriode;
        //     }
        // }

        // dd($val, $periode);

        return view('holtikultura.peramalan.hasilProduksi', [
            'title' => 'produksi',
            'subtitle' => 'hasil',
            'active' => 'forePro',
            'kecamatan' => $kecamatan,
            // 'chart' => $chart,
            'hasil' => $val,
            'periode' => $periode
        ]);
    }

    public function permintaan()
    {
        $kecamatan = \DB::table('kecamatan')->get();
        $permintaan = \DB::table('permintaan')->get();
        // dd($kecamatan);
        return view('holtikultura.peramalan.permintaan', [
            'title' => 'Peramalan permintaan',
            'subtitle' => '',
            'active' => 'forePer',
            'kecamatan' => $kecamatan,
            'permintaan' => $permintaan
        ]);
    }

    public function prosesPermintaan(Kecamatan $kecamatan)
    {
        // dd('masuk');
        $fungsi = new Fungsi;
        $x = $fungsi->getX(); // Periode
        $y = $fungsi->getYPermintaan($kecamatan->id); // Produksi
        $maxPeriode = $fungsi->getMaxPeriode();

        // dd($y);

        if ($y == false) {
            return redirect()->route('forecast.req.index')->with('error_msg', 'Data Permintaan ' . $kecamatan->nama . ' tidak lengkap atau kosong, cek data Permintaan ' . $kecamatan->nama);
        }

        $val = new ForecastPermintaan($x, $y);

        if ($val->res == false) {
            return redirect()->route('forecast.req.index')->with('error_msg', 'Data Permintaan ' . $kecamatan->nama . ' tidak lengkap atau kosong, cek data Permintaan ' . $kecamatan->nama);
        }

        $periode = \DB::table('periode')
            ->orderBy('tahun', 'asc')
            ->orderBy('periode', 'asc')
            ->limit(20)
            ->get();

        // foreach ($periode as $p) {
        //     $data = \DB::table('permintaan')
        //         ->join('periode', 'periode.id', '=', 'permintaan.periode_id')
        //         ->where('kecamatan_id', $kecamatan->id)
        //         ->where([
        //             ['periode.periode', $p->periode],
        //             ['periode.tahun', $p->tahun]
        //         ])
        //         ->select('permintaan.*', 'periode.periode', 'periode.tahun')
        //         ->orderBy('tahun', 'asc')
        //         ->orderBy('periode', 'asc')
        //         ->first();
        //     if ($data) {

        //         $chart['label'][] = $p->tahun . ' T.' . $p->periode;
        //         $chart['data'][] = (int) $data->permintaan;
        //     }
        // }

        // for ($i = 0; $i < count($val->res); $i++) {
        //     $chart['ramal'][] = (int) $val->res[$i];
        //     if ($i == count($periode) && $maxPeriode == 4) {
        //         $chart['label'][$i] = $p->tahun + 1 . ' T.' . 1;
        //     } else {
        //         $chart['label'][$i] = $p->tahun + 1 . ' T.' . $maxPeriode;
        //     }
        // }


        // dd(count($val->res), $val);

        // dd($val);

        return view('holtikultura.peramalan.hasilPermintaan', [
            'title' => 'permintaan',
            'subtitle' => 'hasil',
            'active' => 'forePer',
            'kecamatan' => $kecamatan,
            // 'chart' => $chart,
            'hasil' => $val,
            'periode' => $periode
        ]);
    }
}
