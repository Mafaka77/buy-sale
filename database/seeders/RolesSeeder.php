<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::truncate();
        $roles=[
            [
                'role_name'=>'Super Admin'
            ],
            [
                'role_name'=>'Admin'
            ]
        ];
        foreach ($roles as $role){
            Roles::query()->create($role);
        }
    }
}
