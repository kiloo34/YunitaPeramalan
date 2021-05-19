<?php

use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('periode')->truncate();
        \DB::table('periode')->insert([
            [
                'periode' => '1',
                'tahun' => '2017'
            ],
            [
                'periode' => '2',
                'tahun' => '2017'
            ],
            [
                'periode' => '3',
                'tahun' => '2017'
            ],
            [
                'periode' => '4',
                'tahun' => '2017'
            ],
            [
                'periode' => '1',
                'tahun' => '2018'
            ],
            [
                'periode' => '2',
                'tahun' => '2018'
            ]
        ]);
    }
}
