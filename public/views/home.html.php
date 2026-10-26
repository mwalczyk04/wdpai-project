<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
</head>
<body>
    <header>
        <p><strong>VocabHub</strong></p>
        <nav>
            <a href="/">Pulpit</a>
            <a href="/decks">Talie</a>
            <a href="/forum">Forum</a>
        </nav>
    </header>

    <main>
        <section>
            <h1>Cześć <?= htmlspecialchars($userName) ?>!</h1>
            <p>Karty do powtórki: <?= (int) $dueCardsCount ?></p>
        </section>

        <section>
            <h2>Twoje talie</h2>
            <ul>
                <li>
                    <article>
                        <h3>Talia testowa 1</h3>
                        <a href="/decks/1">Przejdź do talii</a>
                    </article>
                </li>
                <li>
                    <article>
                        <h3>Talia testowa 2</h3>
                        <a href="/decks/2">Przejdź do talii</a>
                    </article>
                </li>
            </ul>
        </section>
    </main>
</body>
</html>