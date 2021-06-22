<?php

namespace App\Http\Controllers\Holtikultura;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \DB::table('mantri')
            ->join('kecamatan', 'kecamatan.id', '=', 'mantri.kecamatan_id')
            ->select('mantri.*', 'kecamatan.nama as namaKecamatan')
            ->get();
        // dd($data);
        return view('holtikultura.mantri.index', [
            'title' => 'mantri',
            'subtitle' => '',
            'active' => 'mantri',
            'mantri' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = \DB::table('kecamatan')->get();
        // dd($data);
        return view('holtikultura.mantri.create', [
            'title' => 'mantri',
            'subtitle' => '',
            'active' => 'mantri',
            'kecamatan' => $data
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
        dd($request->nama_belakang);
        $request->validate([
            'nama_depan' => 'required|regex:/^[a-zA-Z ]+$/',
            'nama_belakang' => 'required|regex:/^[a-zA-Z ]+$/',
            'kecamatan' => 'required'
        ], [
            'nama_depan.regex' => 'Nama Depan harus huruf',
            'nama_depan.required' => 'Nama Depan harap diisi',
            'nama_belakang.regex' => 'Nama Belakang harus huruf',
            'nama_belakang.required' => 'Nama Belakang harap diisi',
            'kecamatan.required' => 'Kecamatan harus diisi'
        ]);

        \DB::table('users')
            ->insert([
                'username' => $request->nama_depan,
                'role_id' => 1,
                'password' => bcrypt('12345678')
            ]);

        $user = \DB::table('users')
            ->where('username', $request->nama_depan)
            ->first();
        // dd($user);

        \DB::table('mantri')
            ->insert([
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'user_id' => $user->id,
                'kecamatan_id' => $request->kecamatan,
                'avatar' => 'https://ui-avatars.com/api/?name=' . $request->nama_depan
            ]);

        return redirect()->route('mantriTani.index')->with('success_msg', 'Mantri ' . $request->nama_depan . ' berhasil ditambah');
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
}
