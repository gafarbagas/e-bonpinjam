<?php

use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agamas')->insert([
            [
                'nama_agama' => 'Islam',
            ],
            [
                'nama_agama' => 'Kristen',
            ],
            [
                'nama_agama' => 'Protestan',
            ],
            [
                'nama_agama' => 'Hindu',
            ],
            [
                'nama_agama' => 'Budha',
            ],
            [
                'nama_agama' => 'Konghucu',
            ],
        ]);
    }
}
