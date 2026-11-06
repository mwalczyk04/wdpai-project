<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Nie znaleziono strony') ?></title>
    <script>
        (function () {
            try {
                const savedTheme = localStorage.getItem('theme');
                const hasSavedTheme = savedTheme === 'light' || savedTheme === 'dark';
                const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                document.documentElement.dataset.theme = hasSavedTheme ? savedTheme : (systemPrefersDark ? 'dark' : 'light');
            } catch (e) {}
        })();
    </script>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/theme.js" defer></script>
    <style>
        .not-found-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: var(--space-2);
        }

        .not-found-title {
            font-size: clamp(4rem, 10vw, 6.5rem);
            font-weight: 800;
            color: var(--color-brand);
            line-height: 1;
        }

        .not-found-desc {
            font-size: 1.25rem;
            color: var(--color-muted);
            margin-bottom: var(--space-2);
        }
    </style>
</head>
<body>
    <main class="container not-found-page">
        <h1 class="not-found-title">404</h1>
        <p class="not-found-desc">Nie znaleziono strony</p>
        <a href="/" class="btn btn-primary">Wróć do strony głównej</a>
    </main>
</body>
</html>
