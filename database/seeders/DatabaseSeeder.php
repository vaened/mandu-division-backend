<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Mandu\Core\Division\Domain\Division;
use function collect;
use function fake;
use function random_int;
use function range;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $parentKeys = Division::factory(10)->create()->map($this->keys());

        collect(range(1, 20))
            ->each(fn() => Division::factory()
                ->state(fn(array $attributes) => [
                    'parent_division_id' => fake()->randomElement($parentKeys),
                ])
                ->has(
                    Division::factory(random_int(1, 3)),
                    'subdivisions'
                )
                ->create([
                    'parent_division_id' => fake()->randomElement($parentKeys),
                ])
            );
    }

    private function keys(): callable
    {
        return static fn(Division $division) => $division->id;
    }
}
