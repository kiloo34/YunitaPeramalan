<?php

use App\Models\Kecamatan;
use App\Periode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            KecamatanSeeder::class,
            PeriodeSeeder::class,
            HoltikulturaSeeder::class,
            MantriSeeder::class,
            ProduksiSeeder::class,
            PermintaanSeeder::class,
            CurahHujanSeeder::class
        ]);
    }
}
