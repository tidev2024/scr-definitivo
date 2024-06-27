<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::create(['name' => 'Vendedor VN']);
        Position::create(['name' => 'Vendedor VD']);
        Position::create(['name' => 'Vendedor VD(antigo)']);
        Position::create(['name' => 'Programador PHP']);
    }
}
