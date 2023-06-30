<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Mandu\Core\Division\Application\SearchSubdivisions\SubdivisionSearcher;
use Mandu\Core\Shared\infrastructure\Controller;
use function response;

final class SearchSubdivisionController extends Controller
{
    public function __construct(private readonly SubdivisionSearcher $searcher)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        return response()->json([
            'data' => $this->searcher->searchOf($id),
        ]);
    }
}
