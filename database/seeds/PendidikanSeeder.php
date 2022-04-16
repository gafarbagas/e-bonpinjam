<?php

use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pendidikans')->insert([
            [
                'nama_pendidikan' => 'Tidak Sekolah',
            ],
            [
                'nama_pendidikan' => 'SD/MI',
            ],
            [
                'nama_pendidikan' => 'SMP/MTS',
            ],
            [
                'nama_pendidikan' => 'SMA/SMK/MAN',
            ],
            [
                'nama_pendidikan' => 'D1/D3/D4',
            ],
            [
                'nama_pendidikan' => 'S1',
            ],
            [
                'nama_pendidikan' => 'S2',
            ],
            [
                'nama_pendidikan' => 'S3',
            ],
        ]);
    }
}
