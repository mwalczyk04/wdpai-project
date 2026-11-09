<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'VocabHub', ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css?v=<?= time() ?>">
    <?php if (!empty($styles) && is_array($styles)): ?>
        <?php foreach ($styles as $style): ?>
            <link rel="stylesheet" href="<?= htmlspecialchars($style, ENT_QUOTES, 'UTF-8') ?>">
        <?php endforeach; ?>
    <?php endif; ?>
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
    <script src="/js/theme.js" defer></script>
    <script src="/js/user-menu.js" defer></script>
</head>
<body>
    <?php if (!($hideHeader ?? false)): ?>
        <?php include __DIR__ . '/components/header.html.php'; ?>
    <?php endif; ?>

    <?= $content ?>
</body>
</html>
