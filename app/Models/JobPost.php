<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPost extends Model
{
    use HasFactory;
    protected $fillable=[
        'salary','qualification','file','mobile','email_address'
    ];

    public function post():BelongsTo
    {
        $this->belongsTo(Post::class);
    }
}
