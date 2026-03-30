<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employer;
/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title'=>$this->faker->jobTitle,
            'salary'=>$this->faker->randomElement(['Ksh 50,000','Ksh 100,000','Ksh 150,000','Ksh 200,000']),
            'location'=>'remote',
            'schedule'=>$this->faker->randomElement(['Full Time','Part Time','Contract']),
            'url'=>$this->faker->url,
            'featured'=>false,
        ];
    }
}
