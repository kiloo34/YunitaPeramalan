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
        return Validator::make($data, [
            'nama_depan' => ['required', 'string', 'max:255',  'regex:/^[a-zA-Z ]+$/'],
            'nama_belakang' => ['required', 'string', 'max:255',  'regex:/^[a-zA-Z ]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
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

        // Peternak::create([
        //     'nama_depan' => $data['nama_depan'],
        //     'nama_belakang' => $data['nama_belakang'],
        //     'user_id' => $user->id
        // ]);

        return $user;
    }
}
