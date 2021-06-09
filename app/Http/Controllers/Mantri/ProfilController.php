<?php

namespace App\Http\Controllers\Mantri;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('mantri.profil.index', [
            'title' => 'profil',
            'subtitle' => '',
            'active' => 'profil'
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama_depan' => 'required|max:255',
            'nama_belakang' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|min:8|confirmed',
        ], [
            'nama_depan.required' => 'Bulan harap diisi',
            'nama_depan.max' => 'Nama Depan maksimal 255 karakter',
            'nama_belakang.required' => 'Bulan harap diisi',
            'nama_belakang.max' => 'Nama Belakang maksimal 255 karakter',
            'email.required' => 'Email harap diisi',
            'email.max' => 'Email maksimal 255 karakter',
            'email.email' => 'Masukan format email',
            'password.required' => 'password harap diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama dengan Konfirmasi password',

        ]);

        \DB::table('users')
            ->where([
                ['id', $user->id],
            ])
            ->update([
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'password' => Hash::make($request->password),
            ]);

        return redirect()->route('mantri.index', $user->id)->with('success_msg', 'Data ' . $request->nama_depan . ' ' . $request->nama_belakang . ' berhasil diubah');
    }
}
