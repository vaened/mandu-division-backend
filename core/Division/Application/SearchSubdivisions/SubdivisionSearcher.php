<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Application\SearchSubdivisions;

use Illuminate\Database\Eloquent\Collection;
use Mandu\Core\Division\Application\Find\DivisionFinder;

final class SubdivisionSearcher
{

    public function __construct(private readonly DivisionFinder $finder)
    {
    }

    public function searchOf(int $divisionId): Collection
    {
        $division = $this->finder->findOrFail($divisionId);
        return $division->subdivisions;
    }
}
