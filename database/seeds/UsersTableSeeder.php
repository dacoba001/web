<?php

use Illuminate\Database\Seeder;

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
            'nombre' => 'Administrador',
            'appaterno' => 'Administrador',
            'apmaterno' => 'Administrador',
            'fecha_nac' => '1990-01-01',
            'telefono' => '4000000',
            'nombredeusuario' => 'admin',
            'tipo_cuenta' => 'Administrador',
            'email' => 'admin',
            'password' => bcrypt('admin'),
        ]);
    }
}
