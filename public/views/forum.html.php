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
            <a href="/forum" aria-current="page">Forum</a>
        </nav>
    </header>

    <main>
        <article>
            <header>
                <h1>Kiedy używać "make", a kiedy "do" w biznesie?</h1>
                <p><small>Autor: Anna (Użytkownik) · 2 godz. temu</small></p>
            </header>
            <p>Zawsze mylę te dwa czasowniki w zwrotach biznesowych. Czy jest na to prosta reguła?</p>
            <button type="button">Głosuj za (12)</button>
        </article>

        <section aria-labelledby="answers-heading">
            <h2 id="answers-heading">Odpowiedzi</h2>

            <article>
                <header>
                    <p><strong>Tomasz</strong> [ADMIN] · <em>Zaakceptowana odpowiedź</em></p>
                </header>
                <p>"Make" łączy się z tworzeniem czegoś nowego, a "do" z rutynowymi czynnościami i pracą.</p>
                <button type="button">Głosuj za (18)</button>
            </article>
        </section>

        <section>
            <h2>Twoja odpowiedź</h2>
            <form action="/forum" method="post">
                <label for="content">Treść:</label>
                <textarea id="content" name="content" rows="4" required></textarea>
                <button type="submit">Dodaj odpowiedź</button>
            </form>
        </section>
    </main>

</body>
</html>