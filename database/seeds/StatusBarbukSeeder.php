<?php

use Illuminate\Database\Seeder;

class StatusBarbukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [
                'nama_status' => 'Disita',
            ],
            [
                'nama_status' => 'Dimusnahkan',
            ],
            [
                'nama_status' => 'Dikembalikan',
            ],
        ]);
    }
}
