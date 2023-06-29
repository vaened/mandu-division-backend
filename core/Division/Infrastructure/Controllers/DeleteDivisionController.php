<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Mandu\Core\Division\Application\Delete\DivisionDeleter;
use Mandu\Core\Shared\infrastructure\Controller;
use Symfony\Component\HttpFoundation\Response;
use function response;

final class DeleteDivisionController extends Controller
{
    public function __construct(private readonly DivisionDeleter $deleter)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $this->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    private function delete(int $divisionId): void
    {
        DB::transaction(fn() => $this->deleter->delete($divisionId));
    }
}
