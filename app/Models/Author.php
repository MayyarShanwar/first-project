<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Author extends Model
{
    use HasFactory, Notifiable;

    // The attributes that are assignable.

    protected $fillable = [
        'name',
        'email'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
