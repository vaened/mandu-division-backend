<?php
/**
 * Created by enea dhack.
 */

namespace Mandu\Components\Laroute\Models;

use Illuminate\Contracts\Support\{Arrayable, Jsonable};
use Illuminate\Support\Collection;

class Module implements Arrayable, Jsonable
{
    private string $name;

    private string $prefix;

    private string $path;

    private bool $absolute;

    private Collection $routes;

    public function __construct(string $name, string $prefix, string $path, bool $absolute)
    {
        $this->name = $name;
        $this->prefix = $prefix;
        $this->path = $path;
        $this->absolute = $absolute;
    }

    public function setRoutes(Collection $routes): void
    {
        $this->routes = $routes;
    }

    public function getRoutes(): Collection
    {
        return $this->routes;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function toArray()
    {
        return [
            'rootUrl' => config('app.url', ''),
            'prefix' => $this->prefix,
            'absolute' => $this->absolute,
            'routes' => $this->routes->toArray(),
        ];
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
