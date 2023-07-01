<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Domain;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mandu\Components\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string ambassador_name
 * @property int parent_division_id
 * @property int collaborators
 *
 * @property Collection subdivisions
 * @property self division
 */
final class Division extends Model
{
    public const COLLABORATOR_ALLOWED_RANGE = [0, 1000];

    protected $fillable = [
        'name',
        'ambassador_name',
        'parent_division_id',
    ];

    public static function create(
        string  $name,
        string  $ambassadorName,
        ?string $parent_division_id
    ): self
    {
        $model = new self([
            'name' => $name,
            'ambassador_name' => $ambassadorName,
            'parent_division_id' => $parent_division_id,
        ]);

        $model->setAttribute('collaborators', self::generateRandomCollaboratorsMembers());

        return $model;
    }

    private static function generateRandomCollaboratorsMembers(): int
    {
        return rand(...self::COLLABORATOR_ALLOWED_RANGE);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_division_id', 'id');
    }

    public function subdivisions(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'subdivisions', 'parent_division_id', 'child_division_id');
    }

    public function values(
        string  $name,
        string  $ambassadorName,
        ?string $parent_division_id
    ): void
    {
        $this->fill([
            'name' => $name,
            'ambassador_name' => $ambassadorName,
            'parent_division_id' => $parent_division_id,
        ]);
    }
}
