<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Mandu\Core\Division\Domain\Division;
use function random_int;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Division::factory(40)->has(
            Division::factory(random_int(0, 4)),
            'subdivisions'
        )->create();
    }
}
