<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminUser::truncate();
        $admins=[
            [
                'name'=>'Super Admin',
                'email'=>'admin@email.com',
                'password'=>bcrypt('password'),
                'roles_id'=>1,
            ]
        ];
        foreach ($admins as $admin){
            AdminUser::query()->create($admin);
        }
    }
}
