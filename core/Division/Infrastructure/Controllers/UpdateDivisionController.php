<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Mandu\Core\Division\Application\Update\DivisionUpdater;
use Mandu\Core\Division\Infrastructure\Request\UpdateDivisionRequest;
use Mandu\Core\Shared\infrastructure\Controller;
use Symfony\Component\HttpFoundation\Response;
use function response;

final class UpdateDivisionController extends Controller
{
    public function __construct(private readonly DivisionUpdater $divisionUpdater)
    {
    }

    public function __invoke(int $id, UpdateDivisionRequest $request): JsonResponse
    {
        $this->divisionUpdater->update(
            $id,
            $request->name(),
            $request->ambassadorName(),
            $request->parentDivisionId()
        );

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
