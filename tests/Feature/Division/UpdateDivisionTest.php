<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Division;

use Mandu\Core\Division\Domain\Division;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use function fake;

final class UpdateDivisionTest extends TestCase
{
    public function test_can_update_a_existing_division(): void
    {
        $division = Division::factory()->create();

        $division->fill([
            'name' => fake()->unique()->name,
            'ambassador_name' => fake()->name,
            'collaborators' => fake()->numberBetween(...Division::COLLABORATOR_ALLOWED_RANGE),
        ]);

        $request = $this->doPut('api.divisions.update', $division->toArray());

        $request->assertNoContent(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas('divisions', $division->toArray());
    }
}
