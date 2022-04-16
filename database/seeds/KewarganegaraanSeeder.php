<?php

use Illuminate\Database\Seeder;

class KewarganegaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kewarganegaraans')->insert([
            [
                'nama_kewarganegaraan' => 'WNI',
            ],
            [
                'nama_kewarganegaraan' => 'WNA',
            ]
        ]);
    }
}
