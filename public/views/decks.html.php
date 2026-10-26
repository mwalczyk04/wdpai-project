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
            <a href="/decks">Talie</a>
            <a href="/forum">Forum</a>
        </nav>
    </header>

    <main>
        <h1><?= htmlspecialchars($pageTitle) ?></h1>
        <ul>
            <li><a href="/decks/1">Talia 1</a></li>
            <li><a href="/decks/2">Talia 2</a></li>
            <li><a href="/decks/3">Talia 3</a></li>
        </ul>
    </main>
</body>
</html>