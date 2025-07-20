<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert([
            [
                'program_name'   => 'Análisis y Desarrollo de Software',
                'technical_sheet' => 2281064,
                'level'          => 'Tecnólogo',
                'initials'       => 'ADSO',
                'mode'           => 'Presencial',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'program_name'   => 'Diseño e Integración de Multimedia',
                'technical_sheet' => 2281065,
                'level'          => 'Tecnólogo',
                'initials'       => 'DIM',
                'mode'           => 'Presencial',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'program_name'   => 'Sistemas',
                'technical_sheet' => 2281066,
                'level'          => 'Técnico',
                'initials'       => 'SIS',
                'mode'           => 'Presencial',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'program_name'   => 'Asistencia Administrativa',
                'technical_sheet' => 2281067,
                'level'          => 'Técnico',
                'initials'       => 'AA',
                'mode'           => 'Presencial',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
