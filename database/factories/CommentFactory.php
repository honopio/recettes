<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Recipe;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Get a random user ID,
            'recipe_id' => Recipe::inRandomOrder()->first()->id, // Get a random recipe ID,
            'content' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        ];
    }
}
