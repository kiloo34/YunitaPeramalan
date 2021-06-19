<?php

namespace App\Http\Controllers\Mantri;

use App\Helpers\ForecastProduksi;
use App\Helpers\Fungsi;
use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Helpers\RegresiLinear;
use App\Models\Produksi;
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
            ->limit(20)
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

        return view('mantri.produksi.index', [
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Kecamatan $kecamatan)
    {
        $periode = \DB::table('periode')->get();
        return view('mantri.produksi.create', [
            'title' => 'produksi',
            'subtitle' => 'create',
            'active' => 'produksi',
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
        $request->harga = str_replace(",", "", $request->harga);
        $kecamatan = \DB::table('kecamatan')
            ->where('nama', $request->kecamatan)
            ->select('id')
            ->first();

        $target = Produksi::where([
            ['periode_id', $request->periode],
            ['kecamatan_id', $kecamatan->id]
        ])->first();
        // dd($request->periode, $kecamatan, $target);
        if ($target) {
            return redirect()->back()->with('error_msg', 'Data Produksi Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' Sudah tersedia');
        }
        $request->validate([
            'periode' => 'required|numeric',
            'tahun' => 'required',
            'kecamatan' => 'required',
            'produksi' => 'required|numeric',
            'luas' => 'required|numeric',
            'harga' => 'required'
        ], [
            'periode.required' => 'Bulan harap diisi',
            'periode.numeric' => 'Periode harus angka',
            'tahun.required' => 'Tahun harap diisi',
            'kecamatan.required' => 'kecamatan harap diisi',
            'produksi.required' => 'Produksi harap diisi',
            'produksi.numeric' => 'Produksi harus angka',
            'luas.required' => 'Luas harap diisi',
            'luas.numeric' => 'Luas harus angka',
            'harga.required' => 'Harga harap diisi',
            'harga.numeric' => 'Harga harus angka',
        ]);

        \DB::table('produksi')
            ->insert([
                'periode_id' => $request->periode,
                'kecamatan_id' => $kecamatan->id,
                'produksi' => $request->produksi,
                'luas_panen' => $request->luas,
                'harga' => $request->harga,
            ]);

        return redirect()->route('produksi.index')->with('success_msg', 'Data Produksi Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' berhasil ditambah');
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

        return view('mantri.produksi.detail', [
            'title' => 'produksi',
            'subtitle' => 'detail',
            'active' => 'produksi',
            'produksi' => $produksi,
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
    public function edit(Kecamatan $kecamatan, Produksi $produksi)
    {
        return view('mantri.produksi.edit', [
            'title' => 'produksi',
            'subtitle' => 'edit',
            'active' => 'produksi',
            'produksi' => $produksi,
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
    public function update(Request $request, Produksi $produksi)
    {
        $request->harga = str_replace(",", "", $request->harga);

        $kecamatan = \DB::table('kecamatan')
            ->where('nama', $request->kecamatan)
            ->select('id', 'nama')
            ->first();
        // dd($produksi, $kecamatan);
        $request->validate([
            'periode' => 'required|numeric',
            'tahun' => 'required',
            'kecamatan' => 'required',
            'produksi' => 'required|numeric',
            'luas' => 'required|numeric',
            'harga' => 'required'
        ], [
            'periode.required' => 'Bulan harap diisi',
            'periode.numeric' => 'Periode harus angka',
            'tahun.required' => 'Tahun harap diisi',
            'kecamatan.required' => 'kecamatan harap diisi',
            'produksi.required' => 'Produksi harap diisi',
            'produksi.numeric' => 'Produksi harus angka',
            'luas.required' => 'Luas harap diisi',
            'luas.numeric' => 'Luas harus angka',
            'harga.required' => 'Harga harap diisi',
            'harga.numeric' => 'Harga harus angka',
        ]);

        \DB::table('produksi')
            ->where([
                ['id', $produksi->id],
                ['kecamatan_id', $kecamatan->id]
            ])
            ->update([
                'produksi' => $request->produksi,
                'luas_panen' => $request->luas,
                'harga' => $request->harga,
            ]);

        return redirect()->route('produksi.show', $kecamatan->id)->with('success_msg', 'Data Produksi Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' Kecamatan ' . $kecamatan->nama . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = \DB::table('produksi')->where('id', $id);
        $target->delete();
        return response()->json([
            'message' => 'Data Produksi berhasil dihapus!'
        ]);
    }

    public function getPeriode($tahun)
    {
        return \DB::table('periode')->where('tahun', $tahun)->get();
    }
}
