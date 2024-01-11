<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Athlete>
 */
class AthleteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'nationalite' => $this->faker->randomElement(['FR','ENG','ALL','USA','CHI','JAP','AUS','NZ','COR','BRA','SWE','BEL']),
            'age' => $this->faker->numberBetween(18,45),
        ];
    }
}
