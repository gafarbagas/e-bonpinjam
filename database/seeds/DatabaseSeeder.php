<?php

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
        $this->call(SuperAdminUserSeeder::class);
        $this->call(BatasPinjamSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AgamaSeeder::class);
        $this->call(KeluargaSeeder::class);
        $this->call(KewarganegaraanSeeder::class);
        $this->call(PendidikanSeeder::class);
        $this->call(StatusBarbukSeeder::class);
        $this->call(StatusPeminjamanSeeder::class);
    }
}
