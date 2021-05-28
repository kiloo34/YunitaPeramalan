<?php

namespace App\Http\Controllers\Mantri;

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
            ->join('produksi', function ($join) {
                $join->on([
                    ['produksi.periode_id', 'permintaan.periode_id'],
                    ['produksi.kecamatan_id', 'permintaan.kecamatan_id']
                ]);
            })
            ->select('permintaan.*', 'periode.periode', 'periode.tahun', 'produksi.harga', 'produksi.luas_panen')
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

            // foreach ($label as $l) {
            //     $chart[$i]['label'][] = $l;
            // }

            foreach ($periode as $p) {
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

        return view('mantri.permintaan.index', [
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function chartPermintaan(Kecamatan $kecamatan)
    {
        $permintaan = \DB::table('permintaan')
            ->join('kecamatan', 'kecamatan.id', '=', 'permintaan.kecamatan_id')
            ->join('periode', 'periode.id', '=', 'permintaan.periode_id')
            ->join('produksi', function ($join) {
                $join->on([
                    ['produksi.periode_id', 'permintaan.periode_id'],
                    ['produksi.kecamatan_id', 'permintaan.kecamatan_id']
                ]);
            })
            ->where('permintaan.kecamatan_id', $kecamatan->id)
            ->select('permintaan.*', 'periode.periode', 'periode.tahun', 'produksi.harga', 'produksi.luas_panen')
            ->orderBy('tahun', 'asc')
            ->orderBy('periode', 'asc')
            ->get();

        $chart = [];
        foreach ($permintaan as $p) {
            $chart['label'][] = $p->tahun . ' T.' . $p->periode;
            $chart['data'][] = (int) $p->permintaan;
        }

        return view('mantri.produksi.permintaan', [
            'title' => 'produksi',
            'subtitle' => 'chart ' . $kecamatan->nama,
            'active' => 'produksi',
            'kecamatan' => $kecamatan,
            'permintaan' => $permintaan,
            'chart' => $chart
        ]);
    }
}
