<?php

use Illuminate\Database\Seeder;

class CurahHujanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('curah_hujan')->truncate();
        \DB::table('curah_hujan')->insert([
            [
                'tahun' => '2017',
                'bulan' => 'januari',
                'nilai' => '244'
            ],
            [
                'tahun' => '2017',
                'bulan' => 'februari',
                'nilai' => '224.8'
            ],
            [
                'tahun' => '2017',
                'bulan' => 'maret',
                'nilai' => '121.1'
            ],
            [
                'tahun' => '2017',
                'bulan' => 'april',
                'nilai' => '35.7'
            ]
        ]);
    }
}
