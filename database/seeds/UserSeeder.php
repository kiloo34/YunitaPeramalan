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
                'username' => 'mantri',
                'nip' => '',
                'password' => bcrypt('12345678'),
                'role_id' => 1
            ],
            [
                'username' => 'holtikultura',
                'nip' => '199801012021011001',
                'password' => bcrypt('12345678'),
                'role_id' => 2
            ]
        ]);
    }
}
