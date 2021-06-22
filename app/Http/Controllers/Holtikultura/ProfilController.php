<?php

namespace App\Http\Controllers\Holtikultura;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('holtikultura.profil.index', [
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
            'nip' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ], [
            'nama_depan.required' => 'Bulan harap diisi',
            'nama_depan.max' => 'Nama Depan maksimal 255 karakter',
            'nama_belakang.required' => 'Bulan harap diisi',
            'nama_belakang.max' => 'Nama Belakang maksimal 255 karakter',
            'nip.required' => 'NIP harap diisi',
            // 'nip.max' => 'NIP maksimal 19 karakter',
            'nip.numeric' => 'NIP harus angka',
            'password.required' => 'password harap diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama dengan Konfirmasi password',

        ]);

        // dd('masuk');

        \DB::table('users')
            ->where([
                ['id', $user->id],
            ])
            ->update([
                'nip' => $request->nip,
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);

        // dd(auth()->user()->id);

        \DB::table('holtikultura')
            ->where('user_id', $user->id)
            ->update([
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'avatar' => 'https://ui-avatars.com/api/?name=' . $request->nama_depan
            ]);

        return redirect()->route('holtikultura.index')->with('success_msg', 'Data ' . $request->nama_depan . ' ' . $request->nama_belakang . ' berhasil diubah');
    }
}
