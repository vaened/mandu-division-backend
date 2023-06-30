<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Division;

use Mandu\Core\Division\Domain\Division;
use Tests\TestCase;
use function json_decode;

final class ListSubdivisionsTest extends TestCase
{
    public function test_list_all_subdivision_id_an_specific_division(): void
    {
        $totalRecords = 8;
        $division = Division::factory()->has(Division::factory($totalRecords), 'subdivisions')->create();

        $request = $this->doGet('api.divisions.subdivisions', ['id' => $division->getKey()]);
        $response = json_decode($request->getContent(), true);

        $request->assertStatus(200);
        $this->assertCount($totalRecords, $response['data']);

    }
}
