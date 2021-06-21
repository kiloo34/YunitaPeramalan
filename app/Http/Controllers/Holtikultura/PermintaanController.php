<?php

namespace App\Http\Controllers\Holtikultura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermintaanController extends Controller
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
            ->limit(20)
            ->get();

        $kecamatan = \DB::table('kecamatan')
            ->orderBy('nama', 'asc')
            ->get();
        $permintaan = \DB::table('permintaan')
            ->join('kecamatan', 'kecamatan.id', '=', 'permintaan.kecamatan_id')
            ->join('periode', 'periode.id', '=', 'permintaan.periode_id')
            // ->join('produksi', function ($join) {
            //     $join->on([
            //         ['produksi.periode_id', 'permintaan.periode_id'],
            //         ['produksi.kecamatan_id', 'permintaan.kecamatan_id']
            //     ]);
            // })
            ->select('permintaan.*', 'periode.periode', 'periode.tahun')
            ->orderBy('tahun', 'desc')
            ->orderBy('periode', 'desc')
            ->get();

        $chart = [];
        $label = [];

        foreach ($periode as $p) {
            $label[] = $p->tahun . ' T.' . $p->periode;
        }

        for ($i = 0; $i < count($kecamatan); $i++) {
            $data = \DB::table('permintaan')
                ->join('kecamatan', 'kecamatan.id', '=', 'permintaan.kecamatan_id')
                ->join('periode', 'periode.id', '=', 'permintaan.periode_id')
                ->join('produksi', function ($join) {
                    $join->on([
                        ['produksi.periode_id', 'permintaan.periode_id'],
                        ['produksi.kecamatan_id', 'permintaan.kecamatan_id']
                    ]);
                })
                ->where('permintaan.kecamatan_id', $kecamatan[$i]->id)
                ->select('permintaan.*', 'periode.periode', 'periode.tahun')
                ->orderBy('tahun', 'desc')
                ->orderBy('periode', 'desc')
                ->limit(20)
                ->get();

            $chart[$i]['kecamatan'] = $kecamatan[$i]->nama;

            foreach ($periode as $p) {
                $data = \DB::table('permintaan')
                    ->join('kecamatan', 'kecamatan.id', '=', 'permintaan.kecamatan_id')
                    ->join('periode', 'periode.id', '=', 'permintaan.periode_id')
                    // ->join('produksi', function ($join) {
                    //     $join->on([
                    //         ['produksi.periode_id', 'permintaan.periode_id'],
                    //         ['produksi.kecamatan_id', 'permintaan.kecamatan_id']
                    //     ]);
                    // })
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

                if (count($data) == 0) {
                    $chart[$i]['label'][] = $p->tahun . ' T.' . $p->periode;
                    $chart[$i]['data'][] = (int) 0;
                } else {
                    foreach ($data as $d) {
                        $chart[$i]['label'][] = $p->tahun . ' T.' . $p->periode;
                        $chart[$i]['data'][] = (int) $d->permintaan;
                    }
                }
            }
        }

        // dd($chart);

        return view('holtikultura.permintaan.index', [
            'title' => 'permintaan',
            'subtitle' => '',
            'active' => 'permintaan',
            'kecamatan' => $kecamatan,
            'permintaan' => $permintaan,
            'periode' => $periode,
            'chart' => $chart,
            'label' => $label
        ]);
    }

    public function show($id)
    {
        $periode = \DB::table('periode')
            ->orderBy('tahun', 'desc')
            ->orderBy('periode', 'desc')
            ->limit(20)
            ->get();
        $kecamatan = \DB::table('kecamatan')
            ->where('id', $id)
            ->first();

        $permintaan = \DB::table('permintaan')
            ->join('periode', 'periode.id', '=', 'permintaan.periode_id')
            ->where('kecamatan_id', $id)
            ->select('permintaan.*', 'periode.periode', 'periode.tahun')
            ->orderBy('tahun', 'desc')
            ->orderBy('periode', 'desc')
            ->get();

        if (count($permintaan) == 0) {
            return redirect()->route('permintaan.index')->with('error_msg', 'Data Permintaan ' . $kecamatan->nama . ' tidak ditemukan');
        }

        foreach ($periode as $p) {
            $data = \DB::table('permintaan')
                ->join('periode', 'periode.id', '=', 'permintaan.periode_id')
                ->where('kecamatan_id', $id)
                ->where([
                    ['periode.periode', $p->periode],
                    ['periode.tahun', $p->tahun]
                ])
                ->select('permintaan.*', 'periode.periode', 'periode.tahun')
                ->orderBy('periode.tahun', 'desc')
                ->orderBy('periode.periode', 'desc')
                ->first();

            if ($data) {
                $chart['label'][] = $p->tahun . ' T.' . $p->periode;
                $chart['data'][] = (int) $data->permintaan;
            }
        }

        // dd($kecamatan, $permintaan, $chart);
        return view('holtikultura.permintaan.detail', [
            'title' => 'permintaan',
            'subtitle' => 'detail',
            'active' => 'permintaan',
            'permintaan' => $permintaan,
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
            $permintaan = \DB::table('permintaan')
                ->join('kecamatan', 'kecamatan.id', '=', 'permintaan.kecamatan_id')
                ->join('periode', 'periode.id', '=', 'permintaan.periode_id')
                ->where('permintaan.periode_id', $periode[$i]->id)
                ->select('permintaan.*', 'periode.periode', 'periode.tahun')
                ->orderBy('tahun', 'desc')
                ->orderBy('periode', 'desc')
                // ->limit(20)
                ->get();
            $rekap[$i]['permintaan'] = 0;
            foreach ($permintaan as $p) {
                // $nilai = (int) $p->permintaan;
                $rekap[$i]['permintaan'] += $p->permintaan;
            }
        }
        // luas lahan produksi
        // dd($rekap);

        return view('holtikultura.permintaan.rekap', [
            'title' => 'permintaan',
            'subtitle' => 'rekapitulasi',
            'active' => 'permintaan',
            'data' => $rekap
        ]);
    }
}
