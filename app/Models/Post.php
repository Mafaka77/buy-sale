<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'title','price','description','full_address','category_id','sub_category_id','user_id','longitude','latitude',
    ];


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function postImage():HasMany
    {
        return $this->hasMany(PostImages::class);
    }

    public function mobilePost():HasOne
    {
        return $this->hasOne(MobilePost::class);
    }

    public function jobPost():HasMany
    {
        return $this->hasMany(JobPost::class);
    }

}
