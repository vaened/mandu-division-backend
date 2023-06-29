<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Application\Delete;

use Mandu\Core\Division\Application\Find\DivisionFinder;
use Mandu\Core\Division\Domain\CannotDeleteDivision;

final class DivisionDeleter
{
    public function __construct(private readonly DivisionFinder $finder)
    {
    }

    public function delete(int $divisionId): void
    {
        $division = $this->finder->findOrFail($divisionId);
        $deleted = $division->delete();

        if (!$deleted) {
            throw new CannotDeleteDivision($division->id, $division->name);
        }
    }
}
