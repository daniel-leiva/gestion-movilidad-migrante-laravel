<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RegistroConducta;

class RegistroConductaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegistroConducta::factory(20)->create();
    }
}
