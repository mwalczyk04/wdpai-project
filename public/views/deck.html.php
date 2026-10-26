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
            <a href="/decks">← Wróć do talii</a>
        </nav>
        <p>Talia ID: <?= (int) $deckId ?> (Karta 1 z 15)</p>
    </header>

    <main>
        <article aria-label="Fiszka">
            <header>
                <p>Słówko do nauki</p>
            </header>
            <section>
            </section>
            <button type="button">Odwróć kartę</button>
        </article>

        <section aria-label="Oceny powtórki">
            <form action="/decks/<?= (int) $deckId ?>" method="post">
                <button type="submit" name="rating" value="again">Powtórz</button>
                <button type="submit" name="rating" value="hard">Trudne</button>
                <button type="submit" name="rating" value="good">Dobre</button>
                <button type="submit" name="rating" value="easy">Łatwe</button>
            </form>
        </section>
    </main>
</body>
</html>