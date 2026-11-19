<?php

declare(strict_types=1);

namespace App\Controller;

abstract class AppController
{
    
    protected function isGet(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? '') === 'GET';
    }

    
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

    /**
     * Renders the 404 Not Found page with the matching HTTP status code.
     */
    protected function renderNotFound(): void
    {
        http_response_code(404);
        $this->render('not-found', [
            'pageTitle' => 'Nie znaleziono strony',
            'hideHeader' => true,
        ]);
    }

    /**
     * Sends an HTTP redirect response and terminates request execution.
     */
    protected function redirect(string $path, int $statusCode = 303): never
    {
        $safePath = str_replace(["\r", "\n"], '', $path);
        header('Location: ' . $safePath, true, $statusCode);
        exit;
    }
}
