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
        <aside>
            <span>PL | EN</span>
            <span>MW</span>
        </aside>
    </header>

    <main>
        <section>
            <h1>Cześć <?= htmlspecialchars($userName) ?>!</h1>
            <p>Karty zaplanowane na dziś: <strong><?= (int) $dueCardsCount ?></strong></p>
            <a href="/decks/1">Rozpocznij powtórkę</a>
        </section>

        <section>
            <header>
                <h2>Twoje talie</h2>
                <a href="/decks/create">+ Utwórz talię</a>
            </header>
            <article>
                <h3>Spanish Basics</h3>
                <p>Poziom: A1 · 40 kart</p>
                <a href="/decks/1">Ucz się</a>
            </article>
            <article>
                <h3>Business English</h3>
                <p>Poziom: B2 · 75 kart</p>
                <a href="/decks/2">Ucz się</a>
            </article>
        </section>

        <section>
            <h2>Szybka minigra</h2>
            <p>Dopasuj pary słówek na czas.</p>
            <a href="/decks/1">Zagraj</a>
        </section>

        <section>
            <h2>Aktywność na forum</h2>
            <article>
                <h3><a href="/forum">Kiedy używać "make", a kiedy "do"?</a></h3>
            </article>
        </section>
    </main>
</body>
</html>