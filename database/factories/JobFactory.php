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
        $salaryMin = $this->faker->randomElement([50000, 100000, 150000, 200000]);
        $salaryMax = $this->faker->optional()->randomElement([$salaryMin, $salaryMin + 25000, $salaryMin + 50000]);

        return [
            'employer_id' => Employer::factory(),
            'title'=>$this->faker->jobTitle,
            'salary_min' => $salaryMin,
            'salary_max' => $salaryMax ?? $salaryMin,
            'salary'=>$salaryMax && $salaryMax !== $salaryMin
                ? 'Ksh ' . number_format($salaryMin) . ' - ' . number_format($salaryMax)
                : 'Ksh ' . number_format($salaryMin),
            'location'=>'remote',
            'schedule'=>$this->faker->randomElement(['Full Time','Part Time','Contract']),
            'url'=>$this->faker->url,
            'featured'=>false,
        ];
    }
}
