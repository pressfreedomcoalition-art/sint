<?php

declare(strict_types=1);

namespace App\View;

use RuntimeException;

final class View
{
    public static function render(string $template, array $data = []): void
    {
        $path = SINT_ROOT . '/views/' . str_replace('.', '/', $template) . '.php';
        if (!is_file($path)) {
            throw new RuntimeException('View not found: ' . $template);
        }

        extract($data, EXTR_SKIP);
        require $path;
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function renderLayout(string $layout, string $contentTemplate, array $data = []): void
    {
        ob_start();
        self::render($contentTemplate, $data);
        $content = ob_get_clean();

        $footerScriptsHtml = '';
        if (!empty($data['footerScripts'])) {
            ob_start();
            self::render((string) $data['footerScripts'], $data);
            $footerScriptsHtml = ob_get_clean();
        }

        self::render('layouts/' . $layout, array_merge($data, [
            'content' => $content,
            'footerScriptsHtml' => $footerScriptsHtml,
        ]));
    }
}
