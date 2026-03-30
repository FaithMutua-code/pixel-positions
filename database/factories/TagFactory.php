<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generate short tag words (not person names)
            'name' => $this->faker->unique()->word(),
            // For multi-word tags: 'name' => $this->faker->unique()->words(2, true),
        ];
    }
}
