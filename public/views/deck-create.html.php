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
                <input type="text" id="deck-title" class="field-input">
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
                        <option>A1</option>
                        <option>A2</option>
                        <option>B1</option>
                        <option>B2</option>
                    </select>
                </div>
            </div>

            <div class="form-field">
                <span class="field-label">Okładka talii</span>
                <div class="upload-dropzone">
                    <span class="upload-icon" aria-hidden="true">🖼️</span>
                    <p class="upload-text">Przeciągnij plik okładki (PNG, JPG do 2MB)</p>
                    <button type="button" class="btn btn-outline" style="width: auto;">Wybierz plik</button>
                </div>
            </div>
        </section>

        <section class="form-box" aria-labelledby="cards-section-heading">
            <div class="cards-section-header">
                <h2 id="cards-section-heading" class="form-box-title">Karty (2)</h2>
                <button type="button" class="btn btn-outline" style="width: auto; padding: 0.35rem 0.75rem; font-size: 0.8125rem;">+ Dodaj kartę</button>
            </div>

            <div class="card-row">
                <div class="form-field">
                    <label for="card-front-1" class="field-label">Przód (słowo)</label>
                    <input type="text" id="card-front-1" class="field-input">
                </div>
                <div class="form-field">
                    <label for="card-back-1" class="field-label">Tył (tłumaczenie)</label>
                    <input type="text" id="card-back-1" class="field-input">
                </div>
                <button type="button" class="btn-delete-card" aria-label="Usuń wiersz">✕</button>
            </div>

            <div class="card-row">
                <div class="form-field">
                    <label for="card-front-2" class="field-label">Przód (słowo)</label>
                    <input type="text" id="card-front-2" class="field-input">
                </div>
                <div class="form-field">
                    <label for="card-back-2" class="field-label">Tył (tłumaczenie)</label>
                    <input type="text" id="card-back-2" class="field-input">
                </div>
                <button type="button" class="btn-delete-card" aria-label="Usuń wiersz">✕</button>
            </div>
        </section>
    </form>
</main>
