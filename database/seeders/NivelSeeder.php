<?php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nivel::insert([
            ['salario' => 10500],
            ['salario' => 14000],
            ['salario' => 19000],
            ['salario' => 28000]
        ]);
    }
}
