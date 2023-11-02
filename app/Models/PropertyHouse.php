<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyHouse extends Model
{
    use HasFactory;
    protected $fillable=[
        'totalArea','totalFloor','floorNo','post_id'
    ];

}
