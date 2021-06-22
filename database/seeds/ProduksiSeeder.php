<?php

use Illuminate\Database\Seeder;

class ProduksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('produksi')->truncate();
        \DB::table('produksi')->insert([
            [
                'luas_panen' => '683',
                'produksi' => '44450',
                'harga' => '13000',
                'periode_id' => 1,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '684',
                'produksi' => '62005',
                'harga' => '6500',
                'periode_id' => 2,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '684',
                'produksi' => '89700',
                'harga' => '12000',
                'periode_id' => 3,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '683',
                'produksi' => '62500',
                'harga' => '2000',
                'periode_id' => 4,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '583',
                'produksi' => '14669',
                'harga' => '4000',
                'periode_id' => 5,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '583',
                'produksi' => '4167',
                'harga' => '13000',
                'periode_id' => 8,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '684',
                'produksi' => '52339',
                'harga' => '13000',
                'periode_id' => 7,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '583',
                'produksi' => '4167',
                'harga' => '13000',
                'periode_id' => 8,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '583',
                'produksi' => '4167',
                'harga' => '12000',
                'periode_id' => 9,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '1025',
                'produksi' => '25153',
                'harga' => '12000',
                'periode_id' => 10,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '583',
                'produksi' => '5900',
                'harga' => '5000',
                'periode_id' => 11,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '583',
                'produksi' => '23038',
                'harga' => '13000',
                'periode_id' => 12,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '583',
                'produksi' => '40071',
                'harga' => '13000',
                'periode_id' => 13,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '683',
                'produksi' => '76120',
                'harga' => '20000',
                'periode_id' => 14,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '683',
                'produksi' => '72010',
                'harga' => '12000',
                'periode_id' => 15,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '600',
                'produksi' => '50000',
                'harga' => '2000',
                'periode_id' => 16,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '1025',
                'produksi' => '15750',
                'harga' => '3000',
                'periode_id' => 17,
                'kecamatan_id' => 1
            ],
            [
                'luas_panen' => '1025',
                'produksi' => '22870',
                'harga' => '10000',
                'periode_id' => 18,
                'kecamatan_id' => 1
            ],
        ]);
    }
}
