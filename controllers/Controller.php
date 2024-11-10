<?php

namespace controllers;

use database\Connection;

abstract class Controller
{
    public function __construct(
        protected readonly Connection $connection,
        protected readonly string     $baseUrl,
        protected readonly array      $viewParams = [],
    ) {
    }

    protected function render(string $view, array $data = []): string {
        $params = ['base_url' => $this->baseUrl] + $this->viewParams + $data;

        $content = file_get_contents($view);

        $layout = file_get_contents('views/layout.html');

        $html = str_replace('{{ content }}', $content, $layout);

        foreach ($params as $key => $value) {
            $html = str_replace('{{ ' . $key . ' }}', $value, $html);
        }

        return $html;
    }

    protected function redirect(string $url): void {
        header('Location: ' . $this->baseUrl . $url);
        die();
    }
}