<?php

namespace Response\Render;

use Helpers\Authenticate;
use Response\HTTPRenderer;

class HTMLRenderer implements HTTPRenderer
{
    private string $viewFile;
    private array $data;

    public function __construct(string $viewFile, array $data)
    {
        $this->viewFile = $viewFile;
        $this->data = $data;
    }
    public function getFields(): array
    {
        return [
            'Content-Type' => 'text/html; charset=utf-8',
        ];
    }

    public function getContent(): string
    {
        $user = Authenticate::getAuthenticatedUser();
        $viewPath = $this->getViewPath($this->viewFile);
        if(!file_exists($viewPath)){
            throw new \Exception("View file not found: " . $viewPath);
        }

        ob_start();
        extract($this->data);
        require $viewPath;
        return $this->getHeader() . ob_get_clean() . $this->getFooter();
    }

    private function getViewPath($viewFile): string
    {
        return sprintf("%s/%s/Views/%s.php", __DIR__, "../../", $viewFile);
    }

    private function getHeader(): string
    {
        ob_start();
        require $this->getViewPath("layout/header");
        require $this->getViewPath("component/message-boxes");
        if (Authenticate::isLoggedIn()) {
            require $this->getViewPath("component/navigator");
        }
        return ob_get_clean();
    }

    private function getFooter(): string
    {
        ob_start();
        require $this->getViewPath("layout/footer");
        return ob_get_clean();
    }
}