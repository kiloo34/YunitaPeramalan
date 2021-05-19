<?php

namespace App\Http\Controllers\Mantri;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Produksi;
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
        $periode = \DB::table('periode')->get();
        $kecamatan = \DB::table('kecamatan')
            ->orderBy('nama', 'asc')
            ->get();
        $produksi = \DB::table('produksi')->get();
        // dd($produksi);
        return view('mantri.produksi.index', [
            'title' => 'produksi',
            'subtitle' => '',
            'active' => 'produksi',
            'kecamatan' => $kecamatan,
            'produksi' => $produksi,
            'periode' => $periode
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
            'permintaan' => 'required|numeric',
            'luas' => 'required|numeric',
            'harga' => 'required'
        ], [
            'periode.required' => 'Bulan harap diisi',
            'periode.numeric' => 'Periode harus angka',
            'tahun.required' => 'Tahun harap diisi',
            'kecamatan.required' => 'kecamatan harap diisi',
            'produksi.required' => 'Produksi harap diisi',
            'produksi.numeric' => 'Produksi harus angka',
            'permintaan.required' => 'Permintaan harap diisi',
            'permintaan.numeric' => 'Permintaan harus angka',
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

        \DB::table('permintaan')
            ->insert([
                'periode_id' => $request->periode,
                'permintaan' => $request->permintaan,
                'kecamatan_id' => $kecamatan->id,
            ]);

        return redirect()->route('produksi.chart', $kecamatan->id)->with('success_msg', 'Data Produksi Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' berhasil ditambah');
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
    public function edit(Produksi $produksi)
    {
        $permintaan = \DB::table('permintaan')
            ->where([
                ['periode_id', $produksi->periode_id],
                ['kecamatan_id', $produksi->kecamatan_id],
            ])->first();
        $kecamatan = \DB::table('kecamatan')->get();
        // dd($produksi, $permintaan->permintaan);
        return view('mantri.produksi.edit', [
            'title' => 'produksi',
            'subtitle' => 'edit',
            'active' => 'produksi',
            'produksi' => $produksi,
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
    public function update(Request $request, Produksi $produksi)
    {
        $request->harga = str_replace(",", "", $request->harga);

        $kecamatan = \DB::table('kecamatan')
            ->where('nama', $request->kecamatan)
            ->select('id')
            ->first();
        // dd($produksi, $kecamatan);
        $request->validate([
            'periode' => 'required|numeric',
            'tahun' => 'required',
            'kecamatan' => 'required',
            'produksi' => 'required|numeric',
            'permintaan' => 'required|numeric',
            'luas' => 'required|numeric',
            'harga' => 'required'
        ], [
            'periode.required' => 'Bulan harap diisi',
            'periode.numeric' => 'Periode harus angka',
            'tahun.required' => 'Tahun harap diisi',
            'kecamatan.required' => 'kecamatan harap diisi',
            'produksi.required' => 'Produksi harap diisi',
            'produksi.numeric' => 'Produksi harus angka',
            'permintaan.required' => 'Permintaan harap diisi',
            'permintaan.numeric' => 'Permintaan harus angka',
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

        \DB::table('permintaan')
            ->where([
                ['periode_id', $produksi->periode_id],
                ['kecamatan_id', $kecamatan->id]
            ])
            ->update([
                'permintaan' => $request->permintaan,
            ]);

        return redirect()->route('produksi.chart', $kecamatan->id)->with('success_msg', 'Data Produksi Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' berhasil diubah');
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

    public function getPeriode($tahun)
    {
        return \DB::table('periode')->where('tahun', $tahun)->get();
    }

    public function chartProduksi(Kecamatan $kecamatan)
    {
        $produksi = \DB::table('produksi')
            ->join('periode', 'produksi.periode_id', '=', 'periode.id')
            ->where('kecamatan_id', $kecamatan->id)
            ->orderBy('tahun', 'asc')
            ->orderBy('periode.periode', 'asc')
            ->select('produksi.*', 'periode.periode', 'periode.tahun')
            ->get();

        // $produksi = Produksi::where('kecamatan_id', $kecamatan->id)
        //     ->get();

        $chart = [];
        foreach ($produksi as $p) {
            $chart['label'][] = $p->tahun . ' T.' . $p->periode;
            $chart['data'][] = (int) $p->produksi;
        }
        // dd($produksi, $chart);
        return view('mantri.produksi.produksi', [
            'title' => 'produksi',
            'subtitle' => 'chart ' . $kecamatan->nama,
            'active' => 'produksi',
            'kecamatan' => $kecamatan,
            'produksi' => $produksi,
            'chart' => $chart
        ]);
    }

    public function chartPermintaan(Kecamatan $kecamatan)
    {
        return view('mantri.produksi.permintaan', [
            'title' => 'produksi',
            'subtitle' => 'chart ' . $kecamatan->nama,
            'active' => 'produksi',
            'kecamatan' => $kecamatan
        ]);
    }
}


// $periode = \DB::table('produksi')
//     ->select('periode', 'tahun')
// ->whereIn('periode', function ($query) {
//     $query->select('periode')
//         ->from('produksi')
//         ->groupBy('periode')
//         ->havingRaw('COUNT(periode) > 1');
// })
// ->when()
// ->whereIn('tahun', function ($query) {
//     $query->select('id')
//         ->from('produksi')
//         ->groupBy('tahun')
//         ->havingRaw('COUNT(*) > 1');
// })
// ->orderBy('tahun', 'asc')
// ->get();

// $dataProduksiKecamatan = \DB::table('produksi')
//     ->join('kecamatan', 'kecamatan.id', '=', 'produksi.kecamatan_id')
//     ->orderBy('tahun', 'asc')
//     ->orderBy('periode', 'asc')
//     ->select('kecamatan.*', 'produksi.produksi', 'produksi.tahun', 'produksi.periode')
//     ->get();

// $dataPermintaanKecamatan = \DB::table('permintaan')
//     ->join('kecamatan', 'kecamatan.id', '=', 'permintaan.kecamatan_id')
//     ->orderBy('tahun', 'asc')
//     ->orderBy('periode', 'asc')
//     ->select('kecamatan.*', 'permintaan.permintaan', 'permintaan.tahun', 'permintaan.periode')
//     ->get();

// dd($periode, $dataProduksiKecamatan, $dataPermintaanKecamatan);

// $chart = new Chart
// $produksi = \DB::table('produksi')
//     ->join('kecamatan', 'kecamatan.id', '=', 'produksi.kecamatan_id')
//     ->join('periode', 'periode.id', '=', 'produksi.periode_id')
//     ->join('permintaan', function ($join) {
//         $join->on([
//             ['permintaan.periode_id', 'produksi.periode_id'],
//             ['permintaan.kecamatan_id', 'produksi.kecamatan_id']
//         ]);
//     })
//     ->orderBy('kecamatan.nama', 'asc')
//     ->orderBy('periode.periode', 'asc')
//     ->orderBy('periode.tahun', 'asc')
//     ->get();

// $chart = [];
// foreach ($record as $row) {
//     $chart['label'][] = $row->day_name;
//     $chart['data'][] = (int) $row->count;
// }
