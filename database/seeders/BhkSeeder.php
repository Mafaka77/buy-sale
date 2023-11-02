<?php

namespace Database\Seeders;

use App\Models\Bhk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BhkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bhk::truncate();
        $bhks=[
            [
                'name'=>'1 Bhk',
            ],
            [
                'name'=>'2 Bhk',
            ]
        ];
        foreach ($bhks as $bhk){
            Bhk::query()->create($bhk);
        }
    }
}
