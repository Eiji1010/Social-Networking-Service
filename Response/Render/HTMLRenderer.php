<?php

namespace Response\Render;

use Response\HTTPRenderer;

class HTMLRenderer implements HTTPRenderer
{
    public function getFields(): array
    {
        return [
            'Content-Type' => 'text/html; charset=utf-8',
        ];
    }

    public function getContent(): string
    {
        $viewPath = $this->getViewPath($this->viewFile);
    }

    private function getViewPath($viewFile)
    {
        return sprintf("%s/%s/Views/%s.php", __DIR__, "../../", $viewFile);
    }
}