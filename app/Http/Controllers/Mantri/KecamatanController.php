<?php

namespace App\Http\Controllers\Mantri;

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
        return view('mantri.kecamatan.index', [
            'title' => 'kecamatan',
            'subtitle' => '',
            'active' => 'produksi',
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
        return view('mantri.kecamatan.create', [
            'title' => 'kecamatan',
            'subtitle' => 'create',
            'active' => 'produksi'
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
            'nama.regex' => 'Nama Kecamatan harus string',
            'nama.required' => 'Nama Kecamatan harap diisi'
        ]);

        $data = Kecamatan::create([
            'nama' => ucfirst($request->nama)
        ]);

        return redirect()->route('kecamatan.index')->with('success_msg', 'Kecamatan ' . $data->nama . ' berhasil ditambah');
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
    public function edit(Kecamatan $kecamatan)
    {
        return view('mantri.kecamatan.edit', [
            'title' => 'kecamatan',
            'subtitle' => 'edit',
            'active' => 'produksi',
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
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'nama' => 'required|regex:/^[a-zA-Z ]+$/|unique:kecamatan,nama'
        ], [
            'nama.unique' => 'Nama Kecamatan sudah ditambahkan',
            'nama.regex' => 'Nama Kecamatan harus string',
            'nama.required' => 'Nama Kecamatan harap diisi'
        ]);

        // dd($request->nama);

        $data = \DB::table('kecamatan')
            ->where('id', $kecamatan->id)
            ->update(['nama' => $request->nama]);

        return redirect()->route('kecamatan.index')->with('success_msg', 'Kecamatan ' . $request->nama . ' berhasil diperbaruhi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $data = \DB::table('kecamatan')->where('id', $id)->get();
        $target = Kecamatan::where('id', $id);
        $target->delete();
        return response()->json([
            'message' => 'Kecamatan berhasil dihapus!'
        ]);
    }
}
