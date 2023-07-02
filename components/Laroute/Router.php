<?php
/**
 * Created by enea dhack.
 */

namespace Mandu\Components\Laroute;

use Closure;
use Illuminate\Routing\Route as LaravelRoute;
use Illuminate\Routing\Router as LaravelRouter;
use Illuminate\Support\{Collection};
use Mandu\Components\Laroute\Models\{Module, Route};

class Router
{
    private Collection $laravelRoutes;

    private ModulesProvider $provider;

    public function __construct(LaravelRouter $router, ModulesProvider $provider)
    {
        $this->laravelRoutes = collect($router->getRoutes());
        $this->provider = $provider;
    }

    public function getModules(): Collection
    {
        return $this->provider->getEmptyModules()->map(fn(Module $module) => $this->attachRoutesTo($module));
    }

    private function attachRoutesTo(Module $module): Module
    {
        $routes = $this->laravelRoutes->filter($this->onlyNamed());
        $module->setRoutes($routes->map($this->toRoute())->values());
        return $module;
    }

    private function onlyNamed(): Closure
    {
        return fn(LaravelRoute $route): bool => $route->getName() != null;
    }

    private function toRoute(): Closure
    {
        return fn(LaravelRoute $route): Route => new Route($route->getName(), $route->uri(), $route->domain());
    }
}
