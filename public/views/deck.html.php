<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
</head>
<body>
    <header>
        <nav>
            <a href="/">Pulpit</a>
            <a href="/decks">Wróć do talii</a>
            <a href="/forum">Forum</a>
        </nav>
    </header>

    <main>
        <h1><?= htmlspecialchars($pageTitle) ?></h1>
        <p>Identyfikator talii z adresu URL: <?= (int) $deckId ?></p>
    </main>
</body>
</html>