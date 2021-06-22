<?php

use Illuminate\Database\Seeder;

class MantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('mantri')->truncate();
        \DB::table('mantri')->insert([
            [
                'nama_depan' => 'mantri',
                'nama_belakang' => 'tani',
                'avatar' => 'https://ui-avatars.com/api/?name=MantriTani',
                'user_id' => 1,
                'kecamatan_id' => 1,
            ],
        ]);
    }
}
