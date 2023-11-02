<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'id','category_name','category_icon','tags',
    ];

    public function subCategory():HasMany
    {
        return  $this->hasMany(SubCategory::class);
    }

    public function brands():HasMany
    {
        return $this->hasMany(Brand::class);
    }

    public function post():HasMany
    {
        return $this->hasMany(Post::class);
    }
}
