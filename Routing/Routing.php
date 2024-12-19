<?php
namespace Routing;
use Closure;

class Routing
{
    private string $path;
    private Closure $callback;

    public function __construct(string $path, Closure $callback)
    {
        $this->path = $path;
        $this->callback = $callback(...);
    }

    public static function create(string $path, Closure $callback): Routing
    {
        return new self($path, $callback);
    }
}