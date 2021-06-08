<?php

namespace App\Http\Controllers\Mantri;

use App\Helpers\Fungsi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $fungsi = new Fungsi;
        $permintaan = $fungsi->getAllDataPermintaan();
        $produksi = $fungsi->getAllDataProduksi();
        $periode = $fungsi->getAllDataPeriode();
        $kecamatan = $fungsi->getAllDataKecamatan();
        // dd($periode, $permintaan, $produksi, $kecamatan);

        foreach ($periode as $p) {
            $label[] = $p->tahun . ' T.' . $p->periode;
        }

        for ($i = 0; $i < count($kecamatan); $i++) {
            $data = \DB::table('produksi')
                ->join('kecamatan', 'kecamatan.id', '=', 'produksi.kecamatan_id')
                ->join('periode', 'periode.id', '=', 'produksi.periode_id')
                ->where('produksi.kecamatan_id', $kecamatan[$i]->id)
                ->select('produksi.*', 'periode.periode', 'periode.tahun')
                ->orderBy('tahun', 'desc')
                ->orderBy('periode', 'desc')
                ->limit(20)
                ->get();

            $chart[$i]['kecamatan'] = $kecamatan[$i]->nama;

            foreach ($periode as $p) {
                $produksi = \DB::table('produksi')
                    ->join('kecamatan', 'kecamatan.id', '=', 'produksi.kecamatan_id')
                    ->join('periode', 'periode.id', '=', 'produksi.periode_id')
                    ->where('produksi.kecamatan_id', $kecamatan[$i]->id)
                    ->where([
                        ['periode.periode', $p->periode],
                        ['periode.tahun', $p->tahun]
                    ])
                    ->select('produksi.*', 'periode.periode', 'periode.tahun')
                    ->orderBy('tahun', 'desc')
                    ->orderBy('periode', 'desc')
                    ->limit(20)
                    ->get();

                $permintaan = \DB::table('permintaan')
                    ->join('kecamatan', 'kecamatan.id', '=', 'permintaan.kecamatan_id')
                    ->join('periode', 'periode.id', '=', 'permintaan.periode_id')
                    ->where('permintaan.kecamatan_id', $kecamatan[$i]->id)
                    ->where([
                        ['periode.periode', $p->periode],
                        ['periode.tahun', $p->tahun]
                    ])
                    ->select('permintaan.*', 'periode.periode', 'periode.tahun')
                    ->orderBy('tahun', 'desc')
                    ->orderBy('periode', 'desc')
                    ->limit(20)
                    ->get();

                if (count($permintaan) == 0 || count($produksi) == 0) {
                    $chart[$i]['label'][] = $p->tahun . ' T.' . $p->periode;
                    $chart[$i]['permintaan'][] = (int) 0;
                    $chart[$i]['produksi'][] = (int) 0;
                } else {
                    foreach ($permintaan as $d) {
                        $chart[$i]['label'][] = $p->tahun . ' T.' . $p->periode;
                        $chart[$i]['permintaan'][] = (int) $d->permintaan;
                    }
                    foreach ($produksi as $d) {
                        $chart[$i]['produksi'][] = (int) $d->produksi;
                    }
                }
            }
        }

        // dd($chart, $label);

        return view('mantri.dashboard', [
            'title' => 'dashboard',
            'subtitle' => '',
            'active' => 'dashboard',
            'kecamatan' => $kecamatan,
            'label' => $label,
            'periode' => $periode,
            'chart' => $chart
        ]);
    }
}
