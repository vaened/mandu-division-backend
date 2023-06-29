<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Application\Create;

use Mandu\Core\Division\Domain\Division;

final class DivisionCreator
{
    public function create(
        string  $name,
        string  $ambassadorName,
        ?string $parent_division_id,
    ): Division
    {
        $division = Division::create($name, $ambassadorName, $parent_division_id);
        $division->save();
        return $division;
    }
}
