<?php
/**
 * Created by enea dhack.
 */

namespace Mandu\Components\Laroute;

use Illuminate\Filesystem\Filesystem;
use Mandu\Components\Laroute\Models\Module;

class Publisher
{
    private Filesystem $filesystem;

    private Router $router;

    public function __construct(Filesystem $filesystem, Router $router)
    {
        $this->filesystem = $filesystem;
        $this->router = $router;
    }

    public function publish(): void
    {
        $this->router->getModules()->each(fn(Module $module) => $this->export($module));
    }

    private function export(Module $module): void
    {
        try {
            $this->filesystem->makeDirectory($module->getPath(), 0755, true, true);
            $this->filesystem->put($this->buildFilePath($module), $module->toJson());
        } catch (\Throwable $error) {
            throw new LarouteException('Something went wrong', 0, $error);
        }
    }

    private function buildFilePath(Module $module): string
    {
        return $module->getPath() . DIRECTORY_SEPARATOR . "{$module->getName()}.json";
    }
}
