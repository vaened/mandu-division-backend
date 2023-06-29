<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Application\Search;

use Illuminate\Database\Eloquent\Collection;
use Mandu\Core\Division\Domain\Division;

final class DivisionSearcher
{
    public function search(): Collection
    {
        return Division::query()->get();
    }
}
