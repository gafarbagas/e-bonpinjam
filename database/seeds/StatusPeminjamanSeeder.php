<?php

use Illuminate\Database\Seeder;

class StatusPeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_peminjamans')->insert([
            [
                'nama_status_peminjaman' => 'Diproses',
            ],
            [
                'nama_status_peminjaman' => 'Disetujui Admin',
            ],
            [
                'nama_status_peminjaman' => 'Disetujui Jaksa',
            ],
            [
                'nama_status_peminjaman' => 'Ditolak Admin',
            ],
            [
                'nama_status_peminjaman' => 'Ditolak Jaksa',
            ],
            [
                'nama_status_peminjaman' => 'Selesai',
            ],
        ]);
    }
}
