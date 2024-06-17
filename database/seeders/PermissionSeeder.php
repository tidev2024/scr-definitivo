<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //EMPRESA
        Permission::create(['name' => 'read-company', 'menu' => 'Empresa', 'short_description' => 'Vizualizar empresas']);
        Permission::create(['name' => 'create-company', 'menu' => 'Empresa', 'short_description' => 'Criar empresas']);
        Permission::create(['name' => 'update-company', 'menu' => 'Empresa', 'short_description' => 'Atualizar empresas']);
        //DEPARTAMENTO
        Permission::create(['name' => 'read-department', 'menu' => 'Departamento', 'short_description' => 'Vizualizar departamento']);
        Permission::create(['name' => 'create-department', 'menu' => 'Departamento', 'short_description' => 'Criar departamento']);
        Permission::create(['name' => 'update-department', 'menu' => 'Departamento', 'short_description' => 'Atualizar departamento']);
        Permission::create(['name' => 'delete-department', 'menu' => 'Departamento', 'short_description' => 'Deletar departamento']);
        //CARGO
        Permission::create(['name' => 'read-position', 'menu' => 'Cargo', 'short_description' => 'Vizualizar cargo']);
        Permission::create(['name' => 'create-position', 'menu' => 'Cargo', 'short_description' => 'Criar cargo']);
        Permission::create(['name' => 'update-position', 'menu' => 'Cargo', 'short_description' => 'Atualizar cargo']);
        Permission::create(['name' => 'delete-position', 'menu' => 'Cargo', 'short_description' => 'Deletar cargo']);
        //USUARIO
        Permission::create(['name' => 'read-user', 'menu' => 'Usuario', 'short_description' => 'Vizualizar usuário']);
        Permission::create(['name' => 'create-user', 'menu' => 'Usuario', 'short_description' => 'Criar usuário']);
        Permission::create(['name' => 'update-user', 'menu' => 'Usuario', 'short_description' => 'Atualizar usuário']);
        //PORCENTAGEM DE COMISSAO
        Permission::create(['name' => 'read-percentageCommission', 'menu' => 'Percentuais comissão VD', 'short_description' => 'Vizualizar porcentagens de comissão de VD']);
        Permission::create(['name' => 'create-percentageCommission', 'menu' => 'Percentuais comissão VD', 'short_description' => 'Criar porcentagens de comissão de VD']);
    }
}
