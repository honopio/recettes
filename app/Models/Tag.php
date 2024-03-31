<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;

class Tag extends Model
{
    use HasFactory;

    /**
     * The recipes that belong to the tag.
     * Many to many relationship so we don't have to create a model for the recipe_tag table
     */
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }

}
