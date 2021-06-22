<?php

use Illuminate\Database\Seeder;

class PermintaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('permintaan')->truncate();
        \DB::table('permintaan')->insert([
            [
                'permintaan' => '38800',
                'periode_id' => 1,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '3621',
                'periode_id' => 1,
                'kecamatan_id' => 2
            ],
            [
                'permintaan' => '62783',
                'periode_id' => 2,
                'kecamatan_id' => 2
            ],
            [
                'permintaan' => '62950',
                'periode_id' => 2,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '89700',
                'periode_id' => 3,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '62500',
                'periode_id' => 4,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '14669',
                'periode_id' => 5,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '4167',
                'periode_id' => 8,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '52339',
                'periode_id' => 7,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '4167',
                'periode_id' => 8,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '4167',
                'periode_id' => 9,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '25153',
                'periode_id' => 10,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '5900',
                'periode_id' => 11,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '23038',
                'periode_id' => 12,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '40071',
                'periode_id' => 13,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '76120',
                'periode_id' => 14,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '72010',
                'periode_id' => 15,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '50000',
                'periode_id' => 16,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '15750',
                'periode_id' => 17,
                'kecamatan_id' => 1
            ],
            [
                'permintaan' => '22870',
                'periode_id' => 18,
                'kecamatan_id' => 1
            ],
        ]);
    }
}
