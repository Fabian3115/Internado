<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        $this->call(UsersTableSeeder::class); // Ejecutar Seeder de User
        $this->call(ProgramsTableSeeder::class); // Ejecutar Seeder de Programa
        DB::commit();
    }
}
