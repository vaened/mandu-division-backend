<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Division;

use Tests\TestCase;

final class CreateDivisionTest extends TestCase
{
    public function test_division_can_create(): void
    {
        $params = [
            'name' => 'Division 1',
            'ambassador_name' => 'Ambassador Name 1',
            'parent_division_id' => null,
        ];

        $request = $this->doPost('api.divisions.create', $params);

        $request->assertCreated();
        $request->assertJsonFragment($params);
        $this->assertDatabaseHas('divisions', $params);
    }
}
