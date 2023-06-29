<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Mandu\Core\Division\Application\Search\DivisionSearcher;
use function response;

final class SearchDivisionsController
{

    public function __construct(private readonly DivisionSearcher $paginator)
    {
    }

    public function __invoke(): JsonResponse
    {
        return response()->json([
            'data' => $this->paginator->search()
        ]);
    }
}
