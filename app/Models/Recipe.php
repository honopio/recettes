<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the recipe.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Get the comments for the recipe.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
