<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Domain;

use Mandu\Components\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string ambassador_name
 * @property int parent_division_id
 * @property int collaborators
 */
final class Division extends Model
{
    private const COLLABORATOR_ALLOWED_RANGE = [0, 1000];

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
}
