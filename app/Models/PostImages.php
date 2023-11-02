<?php

namespace App\Models;

use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostImages extends Model
{
    use HasFactory;
    use MediaAlly;
    protected $fillable=[
        'image_url','post_id',
    ];

    public function post():BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
