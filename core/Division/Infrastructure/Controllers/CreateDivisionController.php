<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Mandu\Core\Division\Application\Create\DivisionCreator;
use Mandu\Core\Division\Domain\Division;
use Mandu\Core\Division\Infrastructure\Request\CreateDivisionRequest;
use Mandu\Core\Shared\infrastructure\Controller;
use Symfony\Component\HttpFoundation\Response;
use function compact;
use function response;

final class CreateDivisionController extends Controller
{
    public function __construct(
        private readonly DivisionCreator $creator
    )
    {
    }

    public function __invoke(CreateDivisionRequest $request): JsonResponse
    {
        $model = $this->createDivisionFrom($request);

        return response()->json(compact('model'), Response::HTTP_CREATED);
    }

    private function createDivisionFrom(CreateDivisionRequest $request): Division
    {
        return DB::transaction(fn() => $this->creator->create(
            $request->name(),
            $request->ambassadorName(),
            $request->parentDivisionId(),
        ));
    }
}
