<?php

namespace App\Http\Controllers\Mantri;

use App\Http\Controllers\Controller;
use App\Models\CurahHujan;
use Illuminate\Http\Request;

class CurahHujanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hujan = \DB::table('curah_hujan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->get();

        return view('mantri.hujan.index', [
            'title' => 'hujan',
            'subtitle' => '',
            'active' => 'hujan',
            'hujan' => $hujan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mantri.hujan.create', [
            'title' => 'hujan',
            'subtitle' => 'create',
            'active' => 'hujan'
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
        $target = CurahHujan::where([
            ['tahun', $request->tahun],
            ['bulan', $request->bulan]
        ])->first();

        if ($target) {
            return redirect()->back()->with('error_msg', 'Data Curah Hujan Bulan ' . $request->bulan . ' Tahun ' . $request->tahun . ' Sudah tersedia');
        }

        $request->validate([
            'bulan' => 'required|regex:/^[a-zA-Z ]+$/',
            'tahun' => 'required|numeric',
            'nilai' => 'required|numeric'
        ], [
            'nilai.numeric' => 'Nilai harus angka',
            'nilai.required' => 'Nilai harap diisi',
            'bulan.required' => 'Bulan harap diisi',
            'bulan.regex' => 'Bulan harus huruf',
            'tahun.required' => 'Tahun harap diisi',
            'tahun.numeric' => 'tahun harus angka',
        ]);
        // dd($request->bulan, $request->tahun, $request->nilai);
        \DB::table('curah_hujan')
            ->insert([
                'bulan' => ucfirst($request->bulan),
                'tahun' => $request->tahun,
                'nilai' => $request->nilai,
            ]);

        return redirect()->route('hujan.index')->with('success_msg', 'Data Curah Hujan bulan ' . $request->bulan . ' Tahun ' . $request->tahun . ' berhasil ditambah');
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
    public function edit(CurahHujan $hujan)
    {
        // $id
        // $hujan = \DB::table('curah_hujan')->where('id', $id)->get();
        // dd($hujan);
        return view('mantri.hujan.edit', [
            'title' => 'hujan',
            'subtitle' => 'edit',
            'active' => 'hujan',
            'hujan' => $hujan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CurahHujan $hujan)
    {
        $request->validate([
            'bulan' => 'required|regex:/^[a-zA-Z ]+$/',
            'tahun' => 'required|numeric',
            'nilai' => 'required|numeric'
        ], [
            'nilai.numeric' => 'Nilai harus angka',
            'nilai.required' => 'Nilai harap diisi',
            'bulan.required' => 'Bulan harap diisi',
            'bulan.regex' => 'Bulan harus huruf',
            'tahun.required' => 'Tahun harap diisi',
            'tahun.numeric' => 'tahun harus angka',
        ]);

        // dd($hujan)

        \DB::table('curah_hujan')
            ->where('id', $hujan->id)
            ->update([
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'nilai' => $request->nilai,
            ]);

        return redirect()->route('hujan.index')->with('success_msg', 'Data Curah Hujan bulan ' . $request->bulan . ' Tahun ' . $request->tahun . ' berhasil perbaruhi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = \DB::table('curah_hujan')->where('id', $id);
        $target->delete();
        return response()->json([
            'message' => 'Data Curah Hujan Bulan berhasil dihapus!'
        ]);
    }
}
