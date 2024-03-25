<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

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

    /**
     * The tags that belong to the recipe.
     * Many to many relationship so we don't have to create a model for the recipe_tag table
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
