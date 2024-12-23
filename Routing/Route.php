<?php
namespace Routing;
use Closure;

class Route
{
    private string $path;
    private array $middleware;
    private Closure $callback;

    public function __construct(string $path, Closure $callback)
    {
        $this->path = $path;
        $this->callback = $callback(...);
    }

    public static function create(string $path, Closure $callback): Route
    {
        return new self($path, $callback);
    }

    public function getCallback(): Closure
    {
        return $this->callback;
    }

    public function setMiddleware(array $middleware): Route
    {
        $this->middleware = $middleware;
        return $this;
    }

    public function getMiddleware(): array
    {
        return $this->middleware ?? [];
    }
}