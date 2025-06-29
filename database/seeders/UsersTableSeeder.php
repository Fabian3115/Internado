<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $personId = DB::table('people')->insertGetId(
            [
                'name' => 'Sara',
                'last_name' => 'Hernandez',
                'type_document' => 'CC',
                'number_document' => 123456789,
                'number_phone' => 9876543210,
                'gender' => 'F',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->insert([
            'nickname' => 'SARAH',
            'email' => 'admin@gmail.com',
            'person_id' => $personId,
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'admin', // Por defecto el rol del 'aprendiz'
            'remember_token' => null,
            'current_team_id' => null,
            'profile_photo_path' => '/public/images/profile_photos/Mamacita.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $personId = DB::table('people')->insertGetId(
            [
                'name' => 'Yiseth',
                'last_name' => 'Patiño',
                'type_document' => 'CC',
                'number_document' => 987654321,
                'number_phone' => 1123456789,
                'gender' => 'F',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->insert([
            'nickname' => 'YISETH',
            'email' => 'aprendiz@gmail.com',
            'person_id' => $personId,
            'email_verified_at' => now(),
            'password' => Hash::make('aprendiz123'),
            'role' => 'aprendiz', // Por defecto el rol del 'aprendiz'
            'remember_token' => null,
            'current_team_id' => null,
            'profile_photo_path' => '/public/images/profile_photos/Mamacita.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
