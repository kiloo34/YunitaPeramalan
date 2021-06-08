<?php

namespace App\Http\Controllers\Mantri;

use App\Http\Controllers\Controller;
use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = \DB::table('periode')->get();
        return view('mantri.periode.index', [
            'title' => 'periode',
            'subtitle' => '',
            'active' => 'dashboard',
            'periode' => $periode
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mantri.periode.create', [
            'title' => 'periode',
            'subtitle' => 'create',
            'active' => 'dashboard',
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
        $exist = \DB::table('periode')
            ->where([
                ['periode', $request->periode],
                ['tahun', $request->tahun]
            ])->first();

        if ($request->periode > (12 / 3)) {
            return redirect()->back()->with('error_msg', 'Periode 4 kali dalam setahun');
        } elseif ($exist) {
            return redirect()->back()->with('error_msg', 'Periode ' . $request->periode . ' sudah tersedia di tahun ' . $request->tahun);
        } else {
            $request->validate([
                'periode' => 'required|numeric',
                'tahun' => 'required|numeric'
            ], [
                'periode.numeric' => 'Periode harus angka',
                'periode.required' => 'Periode harap diisi',
                'tahun.numeric' => 'Tahun harus angka',
                'tahun.required' => 'Tahun harap diisi'
            ]);

            \DB::table('periode')
                ->insert([
                    'periode' => $request->periode,
                    'tahun' => $request->tahun,
                ]);

            return redirect()->route('periode.index')->with('success_msg', 'Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' berhasil ditambah');
        }
        // dd($request->periode > 4, $request->tahun);
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
    public function edit(Periode $periode)
    {
        return view('mantri.periode.edit', [
            'title' => 'periode',
            'subtitle' => 'edit',
            'active' => 'dashboard',
            'periode' => $periode
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periode $periode)
    {
        $request->validate([
            'periode' => 'required|numeric',
            'tahun' => 'required|numeric|'
        ], [
            'periode.numeric' => 'Periode harus angka',
            'periode.required' => 'Periode harap diisi',
            'periode.unique' => 'Periode Sudah tersedia',
            'tahun.numeric' => 'Tahun harus angka',
            'tahun.required' => 'Tahun harap diisi',
            'tahun.unique' => 'Tahun sudah tersedia di periode ini',
        ]);

        if ($periode->periode == $request->periode && $periode->tahun == $request->tahun) {
            \DB::table('periode')
                ->insert([
                    'periode' => $request->periode,
                    'tahun' => $request->tahun,
                ]);
            return redirect()->route('periode.index')->with('success_msg', 'Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' berhasil diubah');
        } else {
            $exist = \DB::table('periode')
                ->where([
                    ['periode', $request->periode],
                    ['tahun', $request->tahun]
                ])->first();
            if ($request->periode > (12 / 3)) {
                return redirect()->back()->with('error_msg', 'Periode 4 kali dalam setahun');
            } elseif ($exist) {
                return redirect()->back()->with('error_msg', 'Periode ' . $request->periode . ' sudah tersedia di tahun ' . $request->tahun);
            } else {
                \DB::table('periode')
                    ->insert([
                        'periode' => $request->periode,
                        'tahun' => $request->tahun,
                    ]);
            }
            return redirect()->route('periode.index')->with('success_msg', 'Periode ' . $request->periode . ' Tahun ' . $request->tahun . ' berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = Periode::where('id', $id);
        $target->delete();
        return response()->json([
            'message' => 'Periode berhasil dihapus!'
        ]);
    }
}
