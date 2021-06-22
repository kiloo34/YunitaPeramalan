<?php

use Illuminate\Database\Seeder;

class HoltikulturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('holtikultura')->truncate();
        \DB::table('holtikultura')->insert([
            [
                'nama_depan' => 'seksi',
                'nama_belakang' => 'holtikultura',
                'avatar' => 'https://ui-avatars.com/api/?name=holtikultura',
                'user_id' => 2
            ]
        ]);
    }
}
