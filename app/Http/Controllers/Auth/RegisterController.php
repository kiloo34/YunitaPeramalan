<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use App\Providers\RouteServiceProvider;
// use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo()
    {
        $for = [
            'mantri'        => 'mantri',
            'holtikultura'  => 'holtikultura'
        ];

        return $this->redirectTo = route($for[auth()->user()->role->nama] . ".dashboard");
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'nama_depan' => ['required', 'max:255',  'regex:/^[a-zA-Z ]+$/'],
            'nama_belakang' => ['required', 'max:255',  'regex:/^[a-zA-Z ]+$/'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];

        $pesan = [
            'nama_depan.max' => 'Nama Depan terlalu banyak',
            'nama_depan.regex' => 'Nama Depan harus huruf',
            'nama_depan.required' => 'Nama Depan harap diisi',
            'nama_belakang.max' => 'Nama Belakang terlalu banyak',
            'nama_belakang.regex' => 'Nama Belakang harus huruf',
            'nama_belakang.required' => 'Nama Belakang harap diisi',
            'email.max' => 'Email terlalu banyak',
            'email.email' => 'Email harus format email',
            'email.required' => 'Email harap diisi',
            'email.unique' => 'Email sudah tersedia',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama dengan password konfirmasi',
            'password.required' => 'Password harap diisi',
        ];

        return Validator::make($data, $rules, $pesan);
        // return $this->validate($data, $rules, $pesan);

        // return Validator::make($data, [
        //     'nama_depan' => ['required', 'string', 'max:255',  'regex:/^[a-zA-Z ]+$/'],
        //     'nama_belakang' => ['required', 'string', 'max:255',  'regex:/^[a-zA-Z ]+$/'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     // 'agree' => ['accepted']
        // ]),[
        //     'nama.unique' => 'Nama Kecamatan sudah ditambahkan',
        //     'nama.regex' => 'Nama Kecamatan harus huruf',
        //     'nama.required' => 'Nama Kecamatan harap diisi'
        // ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = ModelsUser::create([
            'email' => $data['email'],
            'nama_depan' => $data['nama_depan'],
            'nama_belakang' => $data['nama_belakang'],
            'password' => Hash::make($data['password']),
            'avatar' => 'https://ui-avatars.com/api/?name=' . $data['nama_depan'],
            'role_id' => 1
        ]);

        return $user;
    }
}
