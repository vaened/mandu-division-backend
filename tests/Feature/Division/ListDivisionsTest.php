<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Division;

use Mandu\Core\Division\Domain\Division;
use Tests\TestCase;
use function json_decode;

final class ListDivisionsTest extends TestCase
{
    public function test_paginate_all_divisions(): void
    {
        $totalRecords = 10;
        Division::factory($totalRecords)->create();

        $request = $this->doGet('api.divisions');

        $response = json_decode($request->getContent(), true);
        $this->assertCount($totalRecords, $response['data']);
    }
}
