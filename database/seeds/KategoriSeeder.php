<?php

use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            [
                'nama_kategori' => 'Peminjaman',
                'kode_kategori' => 'EBP',
            ],
            [
                'nama_kategori' => 'Terdakwa',
                'kode_kategori' => 'TDW',
            ],[
                'nama_kategori' => 'Barang Bukti',
                'kode_kategori' => 'BB',
            ]
        ]);
    }
}
