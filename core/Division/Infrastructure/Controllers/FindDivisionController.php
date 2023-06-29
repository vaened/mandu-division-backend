<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Mandu\Core\Division\Application\Find\DivisionFinder;
use function response;

final class FindDivisionController
{
    public function __construct(private readonly DivisionFinder $finder)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        return response()->json([
            'division' => $this->finder->findOrFail($id),
        ]);
    }
}
