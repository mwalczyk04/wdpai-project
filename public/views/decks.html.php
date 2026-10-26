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
            <a href="/decks" aria-current="page">Talie</a>
            <a href="/forum">Forum</a>
        </nav>
    </header>

    <main>
        <h1>Przeglądaj talie</h1>

        <section aria-label="Wyszukiwanie i filtry">
            <form action="/decks" method="get">
                <input type="search" name="search" placeholder="Szukaj talii...">
                
                <label for="lang">Język:</label>
                <select id="lang" name="lang">
                    <option value="">Wszystkie</option>
                    <option value="es">Hiszpański</option>
                    <option value="en">Angielski</option>
                </select>

                <label for="level">Poziom:</label>
                <select id="level" name="level">
                    <option value="">Wszystkie</option>
                    <option value="A1">A1</option>
                    <option value="B2">B2</option>
                </select>

                <button type="submit">Szukaj</button>
            </form>
        </section>

        <section aria-label="Lista talii">
            <article>
                <h2>Spanish Basics</h2>
                <p>Poziom: A1 · 40 kart</p>
                <a href="/decks/1">Szczegóły</a>
            </article>
            <article>
                <h2>Business English</h2>
                <p>Poziom: B2 · 75 kart</p>
                <a href="/decks/2">Szczegóły</a>
            </article>
        </section>

        <nav aria-label="Paginacja">
            <a href="/decks?page=1">Poprzednia</a>
            <span>1 z 3</span>
            <a href="/decks?page=2">Następna</a>
        </nav>
    </main>
</body>
</html>