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
            ],
            [
                'tahun' => '2017',
                'bulan' => 'mei',
                'nilai' => '150.9'
            ],
            [
                'tahun' => '2017',
                'bulan' => 'juni',
                'nilai' => '173.2'
            ],
            [
                'tahun' => '2017',
                'bulan' => 'juli',
                'nilai' => '118.4'
            ],
            [
                'tahun' => '2017',
                'bulan' => 'agustus',
                'nilai' => '48.2'
            ],
            [
                'tahun' => '2017',
                'bulan' => 'september',
                'nilai' => '9.3'
            ],
            [
                'tahun' => '2017',
                'bulan' => 'oktober',
                'nilai' => '113.2'
            ],
            [
                'tahun' => '2017',
                'bulan' => 'november',
                'nilai' => '192.5'
            ],
            [
                'tahun' => '2017',
                'bulan' => 'desember',
                'nilai' => '276.6'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'januari',
                'nilai' => '474.3'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'februari',
                'nilai' => '276'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'maret',
                'nilai' => '161.9'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'april',
                'nilai' => '28.9'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'mei',
                'nilai' => '5.9'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'juni',
                'nilai' => '33.1'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'juli',
                'nilai' => '68.5'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'agustus',
                'nilai' => '69.4'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'september',
                'nilai' => '9'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'oktober',
                'nilai' => '0.7'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'november',
                'nilai' => '239.2'
            ],
            [
                'tahun' => '2018',
                'bulan' => 'desember',
                'nilai' => '97.6'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'januari',
                'nilai' => '236.4'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'februari',
                'nilai' => '81.9'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'maret',
                'nilai' => '210.8'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'april',
                'nilai' => '239.5'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'mei',
                'nilai' => '26.1'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'juni',
                'nilai' => '15.5'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'juli',
                'nilai' => '0'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'agustus',
                'nilai' => '6.8'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'september',
                'nilai' => '29.7'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'oktober',
                'nilai' => '0'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'november',
                'nilai' => '2.8'
            ],
            [
                'tahun' => '2019',
                'bulan' => 'desember',
                'nilai' => '11.8'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'januari',
                'nilai' => '136.3'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'februari',
                'nilai' => '257'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'maret',
                'nilai' => '217.1'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'april',
                'nilai' => '40.7'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'mei',
                'nilai' => '232.4'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'juni',
                'nilai' => '77.9'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'juli',
                'nilai' => '81.7'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'agustus',
                'nilai' => '48'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'september',
                'nilai' => '93.9'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'oktober',
                'nilai' => '242'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'november',
                'nilai' => '28.6'
            ],
            [
                'tahun' => '2020',
                'bulan' => 'desember',
                'nilai' => '148.9'
            ]
        ]);
    }
}
