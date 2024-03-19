<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
      /*    //get a random user ID from the users table
        'user_id' => User::inRandomOrder()->first()->id, */
        //generate contact id that auto increments, starting from 1
        'id' => $this->faker->unique()->numberBetween($min = 1, $max = 100),
        'email' => $this->faker->unique()->safeEmail,
        'message' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        ];
    }
}
