<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    
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
    <link rel="stylesheet" href="/css/study.css">
    <script src="/js/theme.js" defer></script>
</head>
<body>
    <?php include __DIR__ . '/components/header.html.php'; ?>

    <main class="container main-content">
        <div class="study-header">
            <div class="session-info">
                <a href="/decks" class="back-link">← Wróć do talii</a>
                <span>·</span>
                <strong>Business English</strong>
                <span>(Karta 5 z 15)</span>
            </div>

            <nav class="mode-switch" aria-label="Tryb nauki">
                <button type="button" class="mode-btn active">Fiszki</button>
                <button type="button" class="mode-btn">Dopasowywanie</button>
            </nav>
        </div>

        <div class="study-area">
            <article class="flashcard" aria-label="Fiszka">
                <span class="flashcard-category">Pojęcie biznesowe · Rzeczownik</span>

                <div class="flashcard-body">
                    <h1 class="flashcard-term">negotiation</h1>
                </div>

                <button type="button" class="flip-prompt">Odwróć kartę (Spacja)</button>
            </article>

            <section class="rating-section" aria-label="Ocena zapamiętania słówka">
                <form action="/decks/<?= (int) $deckId ?>" method="post" class="rating-grid">
                    <button type="submit" name="rating" value="again" class="btn-rate btn-rate-again">Powtórz (1)</button>
                    <button type="submit" name="rating" value="hard" class="btn-rate btn-rate-hard">Trudne (2)</button>
                    <button type="submit" name="rating" value="good" class="btn-rate btn-rate-good">Dobre (3)</button>
                    <button type="submit" name="rating" value="easy" class="btn-rate btn-rate-easy">Łatwe (4)</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>