<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@material.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('estado')->insert([
            'estado' => 'Disponible'
        ]);
        DB::table('estado')->insert([
            'estado' => 'Ocupado'
        ]);
        DB::table('tecnologia')->insert([
            'nombre_tec' => 'Fiberhome'
        ]);
        DB::table('tecnologia')->insert([
            'nombre_tec' => 'Zhone'
        ]);
        DB::table('slots_tec')->insert([
            'id_tecnologia' => '1',
            'slots' => '8'
        ]);
        DB::table('slots_tec')->insert([
            'id_tecnologia' => '1',
            'slots' => '16'
        ]);
        DB::table('slots_tec')->insert([
            'id_tecnologia' => '2',
            'slots' => '4'
        ]);
        DB::table('ciudad')->insert([
            'nombre' => 'Osorno',
            'abreviacion' => 'OSRN',
            'descripcion' => 'Baquedano 955',
            'url' => 'https://goo.gl/maps/5zGknPAqnR9MffqLA',
        ]);
        DB::table('cable')->insert([
            'nombre_cable' => 'Sin cable',
            'id_sitio' => '1'
        ]);
    }
}
