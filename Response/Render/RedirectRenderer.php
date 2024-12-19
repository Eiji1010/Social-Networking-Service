<?php

namespace Response\Render;

use Response\HTTPRenderer;

class RedirectRenderer implements HTTPRenderer
{
    private string $route;
    public function __construct(string $route)
    {
        $this->route = $route;
    }

    public function getFields(): array
    {
        $protocol = !empty($_SERVER['HTTPS']) ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        return [
            'Location' => "$protocol://$host/$this->route"
        ];
    }

    public function getContent(): string
    {
        return '';
    }
}