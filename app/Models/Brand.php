<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model
{
    use HasFactory;
    protected $fillable=[
        'brand_name','category_id','brand_logo',
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
