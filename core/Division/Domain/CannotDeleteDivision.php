<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Domain;

use RuntimeException;
use function sprintf;

final class CannotDeleteDivision extends RuntimeException
{
    public function __construct(int $divisionID, string $divisionName)
    {
        parent::__construct(sprintf('The %s:%d division  cannot be deleted', $divisionName, $divisionID));
    }
}
