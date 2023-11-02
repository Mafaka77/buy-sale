<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();
        $categories=[
            [
                'category_name'=>'Mobiles',
                'category_icon'=>'https://res.cloudinary.com/djyhb9cf6/image/upload/v1694025834/apple_odnxgw.png',
                'tags'=>'mobile'
            ],
            [
                'category_name'=>'Lirthei',
                'category_icon'=>'https://res.cloudinary.com/djyhb9cf6/image/upload/v1694025043/sport-car_k7mq0d.png',
                 'tags'=>'vehicle'
            ],
            [
                'category_name'=>'Electronics',
                'category_icon'=>'https://res.cloudinary.com/djyhb9cf6/image/upload/v1694025360/electric-appliance_l2zbmu.png',
                'tags'=>'electronics'
            ],
            [
                'category_name'=>'Property',
                'category_icon'=>'https://res.cloudinary.com/djyhb9cf6/image/upload/v1694025686/house_xdzdin.png',
                'tags'=>'property'
            ],
            [
                'category_name'=>'Fashion',
                'category_icon'=>'https://res.cloudinary.com/djyhb9cf6/image/upload/v1694025922/brand_pb3g57.png',
                 'tags'=>'fashion'
            ],
            [
                'category_name'=>'Jobs',
                'category_icon'=>'https://res.cloudinary.com/djyhb9cf6/image/upload/v1694025922/brand_pb3g57.png',
                'tags'=>'jobs'
            ],
        ];
        foreach ($categories as $category){
            Category::query()->create($category);
        }
    }
}
