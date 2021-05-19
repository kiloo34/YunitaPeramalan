<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('users')->truncate();
        \DB::table('users')->insert([
            [
                'email' => 'mantri@email.com',
                'nama_depan' => 'mantri',
                'nama_belakang' => 'tani',
                'password' => bcrypt('12345678'),
                'avatar' => 'https://ui-avatars.com/api/?name=MantriTani',
                'role_id' => 1
            ],
            [
                'email' => 'holtikultura@email.com',
                'nama_depan' => 'seksi',
                'nama_belakang' => 'holtikultura',
                'password' => bcrypt('12345678'),
                'avatar' => 'https://ui-avatars.com/api/?name=holtikultura',
                'role_id' => 2
            ]
        ]);
    }
}
