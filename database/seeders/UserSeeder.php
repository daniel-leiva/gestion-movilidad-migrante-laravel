<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Colaborador',
            'email' => 'colaborador@mail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Colaborador');

        User::create([
            'name' => 'Voluntario',
            'email' => 'voluntario@mail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Voluntario');

        User::factory(17)->create();
        
    }
}
