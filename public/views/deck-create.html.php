<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="/css/style.css?v=2">
    <link rel="stylesheet" href="/css/deck-create.css">
</head>
<body>
    <?php include __DIR__ . '/components/header.html.php'; ?>

    <main class="container main-content">
        <form>
            <div class="deck-create-header">
                <h1 class="page-title">Utwórz nową talię</h1>
                <div class="deck-create-actions">
                    <a href="/decks" class="btn btn-outline" style="width: auto;">Anuluj</a>
                    <button type="button" class="btn btn-primary">Zapisz talię</button>
                </div>
            </div>

            <section class="form-box" aria-labelledby="general-info-heading">
                <h2 id="general-info-heading" class="form-box-title">Informacje ogólne</h2>

                <div class="form-field">
                    <label for="deck-title" class="field-label">Tytuł talii</label>
                    <input type="text" id="deck-title" class="field-input" >
                </div>

                <div class="grid-two-cols">
                    <div class="form-field">
                        <label for="deck-lang" class="field-label">Język</label>
                        <select id="deck-lang" class="field-select">
                            <option>Angielski</option>
                            <option>Hiszpański</option>
                            <option>Niemiecki</option>
                            <option>Włoski</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="deck-level" class="field-label">Poziom CEFR</label>
                        <select id="deck-level" class="field-select">
                            <option>A1 - Początkujący</option>
                            <option>A2 - Podstawowy</option>
                            <option>B1 - Średniozaawansowany</option>
                            <option selected>B2 - Średniozaawansowany wyższy</option>
                        </select>
                    </div>
                </div>

                <div class="form-field">
                    <span class="field-label">Zdjęcie okładki</span>
                    <div class="upload-card-box">
                        <p>Przeciągnij plik okładki lub kliknij, aby wybrać z dysku (PNG, JPG do 2MB)</p>
                        <button type="button" class="btn btn-outline" style="width: auto; font-size: 0.8125rem;">Wybierz plik</button>
                    </div>
                </div>
            </section>

            <section class="form-box" style="margin-top: var(--space-4);" aria-labelledby="cards-section-heading">
                <div class="cards-section-header">
                    <h2 id="cards-section-heading" class="form-box-title">Fiszki (2)</h2>
                    <button type="button" class="btn btn-outline" style="width: auto; font-size: 0.8125rem;">+ Dodaj fiszkę</button>
                </div>

                <div class="card-row">
                    <div class="form-field">
                        <label class="field-label">Przód (słowo)</label>
                        <input type="text" class="field-input" >
                    </div>
                    <div class="form-field">
                        <label class="field-label">Tył (tłumaczenie)</label>
                        <input type="text" class="field-input" >
                    </div>
                    <button type="button" class="btn-delete-card" aria-label="Usuń wiersz">✕</button>
                </div>

                <div class="card-row">
                    <div class="form-field">
                        <label class="field-label">Przód (słowo)</label>
                        <input type="text" class="field-input">
                    </div>
                    <div class="form-field">
                        <label class="field-label">Tył (tłumaczenie)</label>
                        <input type="text" class="field-input">
                    </div>
                    <button type="button" class="btn-delete-card" aria-label="Usuń wiersz">✕</button>
                </div>
            </section>
        </form>
    </main>

</body>
</html>