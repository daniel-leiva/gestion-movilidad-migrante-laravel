<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RegistroEnfermo;

class RegistroEnfermoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegistroEnfermo::factory(20)->create();
    }
}
