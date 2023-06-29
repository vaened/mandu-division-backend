<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mandu\Core\Division\Domain\Division;
use function fake;

class DivisionFactory extends Factory
{
    protected $model = Division::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name,
            'ambassador_name' => fake()->name,
            'collaborators' => fake()->numberBetween(...Division::COLLABORATOR_ALLOWED_RANGE),
        ];
    }
}
