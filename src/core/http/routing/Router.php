<?php

namespace Src\core\http\routing;

use Src\core\http\IController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class Router
{
    /** @var list<Route> */
    private static array $routes = [];

    /**
     * @param string $method
     * @param string $name
     * @param array<class-string<IController>, string>|callable(mixed...): Response $handler
     * @return void
     */
    private static function addRoute(string $method, string $name, array|callable $handler): void
    {
        $route = new Route($method, $name, $handler);
        self::$routes[] = $route;
    }

    /**
     * @param string $name
     * @param array<class-string<IController>, string>|callable(mixed...): Response $handler
     * @return void
     */
    public static function get(string $name, array|callable $handler): void
    {
        self::addRoute('GET', $name, $handler);
    }

    /**
     * @param string $name
     * @param array<class-string<IController>, string>|callable(mixed...): Response $handler
     * @return void
     */
    public static function post(string $name, array|callable $handler): void
    {
        self::addRoute('POST', $name, $handler);
    }

    /**
     * @param string $name
     * @param array<class-string<IController>, string>|callable(mixed...): Response $handler
     * @return void
     */
    public static function delete(string $name, array|callable $handler): void
    {
        self::addRoute('DELETE', $name, $handler);
    }

    /**
     * @param string $name
     * @param array<class-string<IController>, string>|callable(mixed...): Response $handler
     * @return void
     */
    public static function put(string $name, array|callable $handler): void
    {
        self::addRoute('PUT', $name, $handler);
    }

    /**
     * @param string $name
     * @param array<class-string<IController>, string>|callable(mixed...): Response $handler
     * @return void
     */
    public static function options(string $name, array|callable $handler): void
    {
        self::addRoute('OPTIONS', $name, $handler);
    }

    public static function run(): Response
    {
        $request = Request::createFromGlobals();

        foreach (self::$routes as $route) {
            if (!$route->match($request->getMethod(), $request->getRequestUri())) {
                continue;
            }

            return $route->call();
        }

        return new Response(
            content: 'Page not found',
            status: 404,
        );
    }
}