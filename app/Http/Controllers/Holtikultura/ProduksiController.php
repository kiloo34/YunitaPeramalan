<?php

namespace App\Http\Controllers\Holtikultura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = \DB::table('periode')
            ->orderBy('tahun', 'desc')
            ->orderBy('periode', 'desc')
            // ->limit(20)
            ->get();

        $kecamatan = \DB::table('kecamatan')
            ->orderBy('nama', 'asc')
            ->get();

        $produksi = \DB::table('produksi')->get();

        $chart = [];
        $label = [];

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
                $data = \DB::table('produksi')
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

                if (count($data) == 0) {
                    $chart[$i]['label'][] = $p->tahun . ' T.' . $p->periode;
                    $chart[$i]['data'][] = (int) 0;
                } else {
                    foreach ($data as $d) {
                        $chart[$i]['label'][] = $p->tahun . ' T.' . $p->periode;
                        $chart[$i]['data'][] = (int) $d->produksi;
                    }
                }
            }
        }

        return view('holtikultura.produksi.index', [
            'title' => 'produksi',
            'subtitle' => '',
            'active' => 'produksi',
            'kecamatan' => $kecamatan,
            'produksi' => $produksi,
            'periode' => $periode,
            'chart' => $chart,
            'label' => $label
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periode = \DB::table('periode')
            ->orderBy('tahun', 'desc')
            ->orderBy('periode', 'desc')
            // ->limit(20)
            ->get();
        $kecamatan = \DB::table('kecamatan')
            ->where('id', $id)
            ->first();
        $produksi = \DB::table('produksi')
            ->where('kecamatan_id', $kecamatan->id)
            ->join('periode', 'periode.id', '=', 'produksi.periode_id')
            ->select('produksi.id', 'produksi.produksi', 'produksi.harga', 'produksi.luas_panen', 'periode.periode', 'periode.tahun')
            ->orderBy('tahun', 'desc')
            ->orderBy('periode', 'desc')
            // ->limit(20)
            ->get();
        if (count($produksi) == 0) {
            return redirect()->route('produksi.index')->with('error_msg', 'Data Produksi ' . $kecamatan->nama . ' tidak ditemukan');
        }
        foreach ($periode as $p) {
            $data = \DB::table('produksi')
                ->join('periode', 'periode.id', '=', 'produksi.periode_id')
                ->where('kecamatan_id', $id)
                ->where([
                    ['periode.periode', $p->periode],
                    ['periode.tahun', $p->tahun]
                ])
                ->select('produksi.*', 'periode.periode', 'periode.tahun')
                ->orderBy('tahun', 'desc')
                ->orderBy('periode', 'desc')
                ->first();
            if ($data) {
                $chart['label'][] = $p->tahun . ' T.' . $p->periode;
                $chart['data'][] = (int) $data->produksi;
            }
        }

        return view('holtikultura.produksi.detail', [
            'title' => 'produksi',
            'subtitle' => 'detail',
            'active' => 'produksi',
            'produksi' => $produksi,
            'kecamatan' => $kecamatan,
            'chart' => $chart,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rekap()
    {
        $kecamatan = \DB::table('kecamatan')
            ->orderBy('nama', 'asc')
            ->get();

        $periode = \DB::table('periode')
            ->orderBy('tahun', 'desc')
            ->orderBy('periode', 'desc')
            // ->limit(20)
            ->get();

        for ($i = 0; $i < count($periode); $i++) {
            $rekap[$i]['periode'] = $periode[$i]->tahun . ' T.' . $periode[$i]->periode;
            $produksi = \DB::table('produksi')
                ->join('kecamatan', 'kecamatan.id', '=', 'produksi.kecamatan_id')
                ->join('periode', 'periode.id', '=', 'produksi.periode_id')
                ->where('produksi.periode_id', $periode[$i]->id)
                ->select('produksi.*', 'periode.periode', 'periode.tahun')
                ->orderBy('tahun', 'desc')
                ->orderBy('periode', 'desc')
                // ->limit(20)
                ->get();
            $rekap[$i]['produksi'] = 0;
            $rekap[$i]['luas_lahan'] = 0;
            foreach ($produksi as $p) {
                // dd(is_int($p->produksi));
                // $nilai = (int) $p->produksi;
                // $luas_panen = (int) $p->luas_panen;
                $rekap[$i]['produksi'] += $p->produksi;
                $rekap[$i]['luas_lahan'] += $p->luas_panen;
                // dd($rekap);
            }

            // $rekap[] = $p->tahun . ' T.' . $p->periode;
            // dd($p, $produksi, $rekap);
        }
        // luas lahan produksi
        // dd($rekap);

        // for ($i = 0; $i < count($kecamatan); $i++) {
        //     $data = \DB::table('produksi')
        //         ->join('kecamatan', 'kecamatan.id', '=', 'produksi.kecamatan_id')
        //         ->join('periode', 'periode.id', '=', 'produksi.periode_id')
        //         ->where('produksi.kecamatan_id', $kecamatan[$i]->id)
        //         ->select('produksi.*', 'periode.periode', 'periode.tahun')
        //         ->orderBy('tahun', 'desc')
        //         ->orderBy('periode', 'desc')
        //         // ->limit(20)
        //         ->get();

        //     $rekap[$i]['kecamatan'] = $kecamatan[$i]->nama;

        //     dd($rekap);


        //     foreach ($periode as $p) {
        //         $data = \DB::table('produksi')
        //             ->join('kecamatan', 'kecamatan.id', '=', 'produksi.kecamatan_id')
        //             ->join('periode', 'periode.id', '=', 'produksi.periode_id')
        //             ->where('produksi.kecamatan_id', $kecamatan[$i]->id)
        //             ->where([
        //                 ['periode.periode', $p->periode],
        //                 ['periode.tahun', $p->tahun]
        //             ])
        //             ->select('produksi.*', 'periode.periode', 'periode.tahun')
        //             ->orderBy('tahun', 'desc')
        //             ->orderBy('periode', 'desc')
        //             ->limit(20)
        //             ->get();

        //         if (count($data) == 0) {
        //             $chart[$i]['label'][] = $p->tahun . ' T.' . $p->periode;
        //             $chart[$i]['data'][] = (int) 0;
        //         } else {
        //             foreach ($data as $d) {
        //                 $chart[$i]['label'][] = $p->tahun . ' T.' . $p->periode;
        //                 $chart[$i]['data'][] = (int) $d->produksi;
        //             }
        //         }
        //     }
        // }

        return view('holtikultura.produksi.rekap', [
            'title' => 'produksi',
            'subtitle' => 'rekapitulasi',
            'active' => 'produksi',
            'data' => $rekap
        ]);
    }
}
