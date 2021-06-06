<?php

namespace App\Http\Controllers\Mantri;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Permintaan;
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
    public function create(Kecamatan $kecamatan)
    {
        // dd($kecamatan);
        $periode = \DB::table('periode')->get();
        return view('mantri.permintaan.create', [
            'title' => 'permintaan',
            'subtitle' => 'create',
            'active' => 'permintaan',
            'kecamatan' => $kecamatan,
            'periode' => $periode
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kecamatan = \DB::table('kecamatan')
            ->where('nama', $request->kecamatan)
            ->select('id')
            ->first();

        $target = Permintaan::where([
            ['periode_id', $request->periode],
            ['kecamatan_id', $kecamatan->id]
        ])->first();

        if ($target) {
            return redirect()->back()->with('error_msg', 'Data Permintaan Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' Sudah tersedia');
        }

        $request->validate([
            'periode' => 'required|numeric',
            'tahun' => 'required',
            'kecamatan' => 'required',
            'permintaan' => 'required|numeric',

        ], [
            'periode.required' => 'Bulan harap diisi',
            'periode.numeric' => 'Periode harus angka',
            'tahun.required' => 'Tahun harap diisi',
            'kecamatan.required' => 'kecamatan harap diisi',
            'permintaan.required' => 'Permintaan harap diisi',
            'permintaan.numeric' => 'Permintaan harus angka',
        ]);

        // dd($kecamatan, $request->periode, $request->permintaan);
        \DB::table('permintaan')
            ->insert([
                'periode_id' => $request->periode,
                'permintaan' => $request->permintaan,
                'kecamatan_id' => $kecamatan->id,
            ]);

        return redirect()->route('permintaan.index')->with('success_msg', 'Data Permintaan Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' berhasil ditambah');
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
        return view('mantri.permintaan.detail', [
            'title' => 'permintaan',
            'subtitle' => 'detail',
            'active' => 'permintaan',
            'permintaan' => $permintaan,
            'kecamatan' => $kecamatan,
            'chart' => $chart,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan, Permintaan $permintaan)
    {
        return view('mantri.permintaan.edit', [
            'title' => 'permintaan',
            'subtitle' => 'edit',
            'active' => 'permintaan',
            'permintaan' => $permintaan,
            'kecamatan' => $kecamatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permintaan $permintaan)
    {
        $kecamatan = \DB::table('kecamatan')
            ->where('nama', $request->kecamatan)
            ->select('id', 'nama')
            ->first();
        // dd($permintaan, $kecamatan);
        $request->validate([
            'periode' => 'required|numeric',
            'tahun' => 'required',
            'kecamatan' => 'required',
            'permintaan' => 'required|numeric',
            'permintaan' => 'required|numeric',
        ], [
            'periode.required' => 'Bulan harap diisi',
            'periode.numeric' => 'Periode harus angka',
            'tahun.required' => 'Tahun harap diisi',
            'kecamatan.required' => 'kecamatan harap diisi',
            'produksi.required' => 'Produksi harap diisi',
            'produksi.numeric' => 'Produksi harus angka',
            'permintaan.required' => 'Permintaan harap diisi',
            'permintaan.numeric' => 'Permintaan harus angka',
        ]);

        \DB::table('permintaan')
            ->where([
                ['periode_id', $permintaan->periode_id],
                ['kecamatan_id', $kecamatan->id]
            ])
            ->update([
                'permintaan' => $request->permintaan,
            ]);

        return redirect()->route('permintaan.show', $kecamatan->id)->with('success_msg', 'Data Permintaan Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' Kecamatan ' . $kecamatan->nama . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = \DB::table('permintaan')->where('id', $id);
        $target->delete();
        return response()->json([
            'message' => 'Data Permintaan berhasil dihapus!'
        ]);
    }
}
