<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cargo::insert([
            ['nombre_cargo' => 'Asistente'],
            ['nombre_cargo' => 'Supervisor'],
            ['nombre_cargo' => 'Coordinador'],
            ['nombre_cargo' => 'Gerente'],
        ]);
    }
}
