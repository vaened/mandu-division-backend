<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Testing\TestResponse;
use function implode;
use function Lambdish\Phunctional\map;
use function route;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithoutMiddleware, RefreshDatabase;

    public function doPost(string $name, array $data = [], array $headers = []): TestResponse
    {
        return parent::post(route($name), $data, $headers);
    }

    public function doDelete(string $name, array $data = [], array $headers = []): TestResponse
    {
        return parent::delete(route($name, $data), $data, $headers);
    }
    public function doPut(string $name, array $data = [], array $headers = []): TestResponse
    {
        return parent::put(route($name, $data), $data, $headers);
    }

    public function doGet(string $name, array $data = [], array $headers = []): TestResponse
    {
        $route = route($name, $data);
        $params = implode('&', map(fn(mixed $value, string $key) => "$key=$value", $data));

        return parent::get(
            !empty($params) ? "$route?$params" : $route,
            $headers
        );
    }
}
