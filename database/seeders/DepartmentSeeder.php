<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create(['name' => 'Venda Direta']);
        Department::create(['name' => 'Venda Veículos Novos']);
        Department::create(['name' => 'Venda Veículos Usados']);
        Department::create(['name' => 'T.I.']);
    }
}
