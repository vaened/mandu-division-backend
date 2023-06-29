<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Mandu\Core\Division\Infrastructure\Request;

use Mandu\Core\Shared\infrastructure\FormRequest;

final class CreateDivisionRequest extends FormRequest
{

    public function name(): string
    {
        return $this->input('name');
    }

    public function ambassadorName(): string
    {
        return $this->input('ambassador_name');
    }

    public function parentDivisionId(): ?int
    {
        return $this->filled('parent_division_id') ?
            (int)$this->input('parent_division_id') :
            null;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:45',
            'ambassador_name' => 'required',
            'parent_division_id' => 'nullable|integer',
        ];
    }
}
