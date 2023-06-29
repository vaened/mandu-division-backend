<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Components\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use function sprintf;

abstract class Model extends EloquentModel
{
    use HasFactory;

    public $timestamps = false;

    protected static function newFactory(): Factory
    {
        $factory = sprintf('Database\Factories\%sFactory', basename(str_replace('\\', '/', static::class)));
        return new $factory();
    }

}
