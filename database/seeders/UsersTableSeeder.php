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
            'estado' => 'Libre'
        ]);
        DB::table('estado')->insert([
            'estado' => 'Ocupado'
        ]);
        DB::table('tecnologia')->insert([
            'nombre_tec' => 'Zhone'
        ]);
        DB::table('tecnologia')->insert([
            'nombre_tec' => 'Fiberhome 5000 Series'
        ]);
        DB::table('tecnologia')->insert([
            'nombre_tec' => 'Fiberhome 6000 Series'
        ]);
        DB::table('slots_tec')->insert([
            'id_tecnologia' => '2',
            'slots' => '8'
        ]);
        DB::table('slots_tec')->insert([
            'id_tecnologia' => '2',
            'slots' => '16'
        ]);
        DB::table('slots_tec')->insert([
            'id_tecnologia' => '1',
            'slots' => '4'
        ]);
        DB::table('slots_tec')->insert([
            'id_tecnologia' => '3',
            'slots' => '16'
        ]);
        DB::table('ciudad')->insert([
            'nombre' => 'Osorno',
            'abreviacion' => 'OSRN',
            'direccion' => 'Baquedano 955',
            'descripcion'=>'Central Baquedano',
            'url' => 'https://goo.gl/maps/5zGknPAqnR9MffqLA',
        ]);
        DB::table('cable')->insert([
            'nombre_cable' => 'Sin cable',
            'id_sitio' => '1'
        ]);
        DB::table('tipo_cable')->insert([
            'tipo' => 'Enlace',
        ]);
        DB::table('tipo_cable')->insert([
            'tipo' => 'Troncal',
        ]);
        DB::table('tipo_cable')->insert([
            'tipo' => 'Anillo',
        ]);
        DB::table('tipo_cable')->insert([
            'tipo' => 'PEXT',
        ]);
        DB::table('tipo_cable')->insert([
            'tipo' => 'Empresa',
        ]);
        DB::table('comprobar')->insert([
            'comprobar' => 'OK',
        ]);
        DB::table('comprobar')->insert([
            'comprobar' => 'No OK',
        ]);
        DB::table('gravedad_alerta')->insert([
            'gravedad' => 'Baja',
        ]);
        DB::table('gravedad_alerta')->insert([
            'gravedad' => 'Media',
        ]);
        DB::table('gravedad_alerta')->insert([
            'gravedad' => 'Alta',
        ]);
    }
}
