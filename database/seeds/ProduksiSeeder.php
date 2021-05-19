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
        \DB::table('kecamatan')->truncate();
        \DB::table('kecamatan')->insert([
            [
                'nama' => 'bangorejo'
            ],
            [
                'nama' => 'pesanggaran'
            ],
            [
                'nama' => 'siliragung'
            ],
            [
                'nama' => 'muncar'
            ],
            [
                'nama' => 'purwoharjo'
            ],
            [
                'nama' => 'tegaldlimo'
            ]
        ]);
    }
}
