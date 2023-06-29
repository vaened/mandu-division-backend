<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Application\Update;

use Mandu\Core\Division\Application\Find\DivisionFinder;
use Mandu\Core\Division\Domain\Division;

final class DivisionUpdater
{
    public function __construct(private readonly DivisionFinder $finder)
    {
    }

    public function update(
        int     $divisionId,
        string  $name,
        string  $ambassadorName,
        ?string $parent_division_id,
    ): Division
    {
        $division = $this->finder->findOrFail($divisionId);

        $division->values($name, $ambassadorName, $parent_division_id);
        $division->save();

        return $division;
    }
}
