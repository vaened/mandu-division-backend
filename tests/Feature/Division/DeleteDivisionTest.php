<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Division;

use Mandu\Core\Division\Domain\Division;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class DeleteDivisionTest extends TestCase
{

    public function test_can_delete_a_division(): void
    {
        $division = Division::factory(2)->create()->first();

        $request = $this->doDelete('api.divisions.delete', ['id' => $division->getKey()]);

        $request->assertNoContent(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseCount('divisions', 1);
    }
}
