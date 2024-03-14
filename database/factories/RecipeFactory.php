<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($this->faker));
        $title = $this->faker->numerify($this->faker->foodName(). ' ###');
        return [
         'user_id' => User::inRandomOrder()->first()->id, // Get a random user ID,
         'title' => $title,
         'content' => $this->faker->paragraph($nbSentences = 10, $variableNbSentences = true),
         'ingredients' => $this->faker->vegetableName().", ".$this->faker->meatName(),
         'price' => $this->faker->words($nb = 1, $asText = true),
         'url' => str_replace(' ', '-', $title),
         //50% chance of the recipe having tags. if so, between 1 and 5 tags are generated
         'tags' => $this->faker->boolean(50) ? $this->faker->words($nb = $this->faker->numberBetween(1, 5), $asText = true) : null,
         'status' => 'published',
        ];
    }
}
