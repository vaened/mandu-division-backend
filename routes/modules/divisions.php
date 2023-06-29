<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

// Routes ${host}/api/

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Mandu\Core\Division\Infrastructure\Controllers as Division;

Route::post('create', Division\CreateDivisionController::class)->name('api.divisions.create');
Route::get('/', Division\SearchDivisionsController::class)->name('api.divisions');
Route::get('{id}', Division\FindDivisionController::class)->name('api.divisions.find');
Route::delete('{id}', Division\DeleteDivisionController::class)->name('api.divisions.delete');
Route::put('{id}', Division\UpdateDivisionController::class)->name('api.divisions.update');

