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
            'password' => 'required|min:8|confirmed',
            'username' => 'required|unique:users,username,' . $user->username
        ], [
            'nama_depan.required' => 'Bulan harap diisi',
            'nama_depan.max' => 'Nama Depan maksimal 255 karakter',
            'nama_belakang.required' => 'Bulan harap diisi',
            'nama_belakang.max' => 'Nama Belakang maksimal 255 karakter',
            'password.required' => 'password harap diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama dengan Konfirmasi password',
            'username.required' => 'Username harap diisi',
            'username.unique' => 'Username sudah tersedia gunakan username lain',
        ]);

        \DB::table('users')
            ->where([
                ['id', $user->id],
            ])
            ->update([
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);

        \DB::table('mantri')
            ->where(
                ['user_id' => $user->id]
            )
            ->update([
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'avatar' => 'https://ui-avatars.com/api/?name=' . $request->nama_depan
            ]);

        return redirect()->route('mantri.index')->with('success_msg', 'Data ' . $request->nama_depan . ' ' . $request->nama_belakang . ' berhasil diubah');
    }
}
