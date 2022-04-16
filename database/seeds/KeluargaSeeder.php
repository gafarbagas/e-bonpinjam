<?php

use Illuminate\Database\Seeder;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keluargas')->insert([
            [
                'keluarga' => 'Bin',
            ],
            [
                'keluarga' => 'Binti',
            ]
        ]);
    }
}
