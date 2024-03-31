<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ingredient;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($this->faker));

        $nomIngredient = $this->faker->unique()->randomElement([
            $this->faker->vegetableName(),
            $this->faker->meatName(),
            $this->faker->sauceName(),
            $this->faker->dairyName(),
            $this->faker->fruitName(),
        ]);

        return [
            'name' => $nomIngredient,
        ];

    }
}
