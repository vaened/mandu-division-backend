<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Application\Find;

use Mandu\Core\Division\Domain\Division;
use Mandu\Core\Division\Domain\NotFoundDivision;

final class DivisionFinder
{
    public function findOrFail(int $divisionId): Division
    {
        $division = Division::query()->find($divisionId);

        if (null === $division) {
            throw (new NotFoundDivision())->setModel(Division::class);
        }

        return $division;
    }
}
