<?php

declare(strict_types=1);

namespace App\Controller;

abstract class AppController
{
    /**
     * Check whether the current HTTP request uses the GET method.
     */
    protected function isGet(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? '') === 'GET';
    }

    /**
     * Check whether the current HTTP request uses the POST method.
     */
    protected function isPost(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST';
    }

    protected function render(string $template, array $variables = []): void
    {
        $viewsPath = dirname(__DIR__, 2) . '/public/views';
        $templatePath = $viewsPath . '/' . $template . '.html.php';
        $layoutPath = $viewsPath . '/layout.html.php';

        if (!is_file($templatePath)) {
            throw new \RuntimeException('View not found: ' . $template);
        }

        extract($variables, EXTR_SKIP);

        ob_start();
        require $templatePath;
        $content = (string) ob_get_clean();

        require $layoutPath;
    }
}
