<?php

namespace App\Http\Controllers\Holtikultura;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatan = \DB::table('kecamatan')->get();
        return view('holtikultura.kecamatan.index', [
            'title' => 'kecamatan',
            'subtitle' => '',
            'active' => 'kecamatan',
            'kecamatan' => $kecamatan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('holtikultura.kecamatan.create', [
            'title' => 'kec',
            'subtitle' => 'create',
            'active' => 'kecamatan'
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
        $target = Kecamatan::where([
            ['nama', $request->nama],
        ])->first();

        if ($target) {
            return redirect()->back()->with('error_msg', 'Data Kecamatan ' . $request->nama . ' Sudah tersedia');
        }

        $request->validate([
            'nama' => 'required|regex:/^[a-zA-Z ]+$/|unique:kecamatan,nama'
        ], [
            'nama.unique' => 'Nama Kecamatan sudah ditambahkan',
            'nama.regex' => 'Nama Kecamatan harus huruf',
            'nama.required' => 'Nama Kecamatan harap diisi'
        ]);

        $data = Kecamatan::create([
            'nama' => ucfirst($request->nama)
        ]);

        return redirect()->route('kec.index')->with('success_msg', 'Kecamatan ' . $data->nama . ' berhasil ditambah');
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
    public function edit(Kecamatan $kec)
    {
        return view('holtikultura.kecamatan.edit', [
            'title' => 'kecamatan',
            'subtitle' => 'edit',
            'active' => 'kecamatan',
            'kecamatan' => $kec
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kec)
    {
        $request->validate([
            'nama' => 'required|regex:/^[a-zA-Z ]+$/|unique:kecamatan,nama,' . $kec->id
        ], [
            'nama.unique' => 'Nama Kecamatan sudah ditambahkan',
            'nama.regex' => 'Nama Kecamatan harus huruf',
            'nama.required' => 'Nama Kecamatan harap diisi'
        ]);

        // dd($request->nama);

        $data = \DB::table('kecamatan')
            ->where('id', $kec->id)
            ->update(['nama' => $request->nama]);

        return redirect()->route('kec.index')->with('success_msg', 'Kecamatan ' . $request->nama . ' berhasil diperbaruhi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target = Kecamatan::where('id', $id);
        $target->delete();
        return response()->json([
            'message' => 'Kecamatan berhasil dihapus!'
        ]);
    }
}
