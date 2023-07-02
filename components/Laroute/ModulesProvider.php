<?php
/**
 * Created by enea dhack.
 */

namespace Mandu\Components\Laroute;

use Illuminate\Config\Repository;
use Illuminate\Support\Collection;
use LogicException;
use Mandu\Components\Laroute\Models\Module;

class ModulesProvider
{
    private Repository $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function getEmptyModules(): Collection
    {
        $modules = collect($this->config->get('laroute', []));
        $this->validateDuplicates($modules);
        return $modules->map(fn(array $config) => $this->createModule($config));
    }

    private function validateDuplicates(Collection $modules): void
    {
        $modules->duplicates(fn(array $config) => $config['module'])->some(function (string $name): void {
            throw new LogicException("Module '{$name}' is already registered");
        });
    }

    private function createModule(array $config): Module
    {
        return new Module($config['module'], $config['prefix'], $config['path'], $config['absolute']);
    }
}
