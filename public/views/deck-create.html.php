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
        </nav>
    </header>

    <main>
        <h1>Utwórz nową talię</h1>

        <form action="/decks/create" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Informacje o talii</legend>
                
                <label for="title">Tytuł talii:</label>
                <input type="text" id="title" name="title" required>

                <label for="language">Język:</label>
                <select id="language" name="language">
                    <option value="en">Angielski</option>
                    <option value="es">Hiszpański</option>
                </select>

                <label for="level">Poziom:</label>
                <select id="level" name="level">
                    <option value="A1">A1</option>
                    <option value="B2">B2</option>
                </select>

                <label for="cover">Zdjęcie okładki:</label>
                <input type="file" id="cover" name="cover" accept="image/png, image/jpeg">
            </fieldset>

            <fieldset>
                <legend>Fiszka</legend>
                <label for="front">Awers (słowo):</label>
                <input type="text" id="front" name="front" required>

                <label for="back">Rewers (tłumaczenie):</label>
                <input type="text" id="back" name="back" required>
            </fieldset>

            <button type="submit">Zapisz talię</button>
            <a href="/decks">Anuluj</a>
        </form>
    </main>

</body>
</html>