<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Division;

use Mandu\Core\Division\Domain\Division;
use Tests\TestCase;

final class FindDivisionTest extends TestCase
{
    public function test_can_find_a_division(): void
    {
        $division = Division::factory()->create();

        $request = $this->doGet('api.divisions.find', ['id' => $division->getKey()]);

        $request->assertJsonFragment($division->toArray());
    }
}
