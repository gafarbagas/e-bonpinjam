<?php

use Illuminate\Database\Seeder;

class BatasPinjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('batas_pinjams')->insert([
            'batas_pinjam' => '3',
        ]);
    }
}
