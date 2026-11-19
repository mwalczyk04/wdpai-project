<?php
$old = is_array($old ?? null) ? $old : [];
$errors = is_array($errors ?? null) ? $errors : [];
$languages = is_array($languages ?? null) ? $languages : [];
$cefrLevels = is_array($cefrLevels ?? null) ? $cefrLevels : [];
$statuses = is_array($statuses ?? null) ? $statuses : [];
$formHeading = (string) ($formHeading ?? 'Utwórz nową talię');
$formAction = (string) ($formAction ?? '/decks/create');
$cancelUrl = (string) ($cancelUrl ?? '/decks');
$submitLabel = (string) ($submitLabel ?? 'Zapisz talię');
?>
<main class="container main-content">
    <form method="post" action="<?= htmlspecialchars($formAction, ENT_QUOTES, 'UTF-8') ?>">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars((string) ($csrfToken ?? ''), ENT_QUOTES, 'UTF-8') ?>">

        <div class="deck-create-header">
            <h1 class="page-title"><?= htmlspecialchars($formHeading, ENT_QUOTES, 'UTF-8') ?></h1>
            <div class="deck-create-actions">
                <a href="<?= htmlspecialchars($cancelUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-outline" style="width: auto;">Anuluj</a>
                <button type="submit" class="btn btn-primary"><?= htmlspecialchars($submitLabel, ENT_QUOTES, 'UTF-8') ?></button>
            </div>
        </div>

        <?php if ($errors !== []): ?>
            <div class="form-errors" role="alert">
                <strong>Popraw błędy formularza:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars((string) $error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <section class="form-box" aria-labelledby="general-info-heading">
            <h2 id="general-info-heading" class="form-box-title">Informacje ogólne</h2>

            <div class="form-field">
                <label for="deck-title" class="field-label">Tytuł talii</label>
                <input
                    type="text"
                    id="deck-title"
                    name="title"
                    class="field-input"
                    maxlength="150"
                    required
                    placeholder="np. Spanish Basics"
                    value="<?= htmlspecialchars((string) ($old['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                >
            </div>

            <div class="form-field">
                <label for="deck-description" class="field-label">Opis talii (opcjonalny)</label>
                <textarea
                    id="deck-description"
                    name="description"
                    class="field-input"
                    rows="3"
                    placeholder="Krótki opis zakresu słownictwa w tej talii..."
                ><?= htmlspecialchars((string) ($old['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <div class="grid-three-cols">
                <div class="form-field">
                    <label for="deck-lang" class="field-label">Język</label>
                    <select id="deck-lang" name="language" class="field-select">
                        <?php foreach ($languages as $code => $label): ?>
                            <option value="<?= htmlspecialchars((string) $code, ENT_QUOTES, 'UTF-8') ?>"<?= ($old['language'] ?? 'en') === $code ? ' selected' : '' ?>>
                                <?= htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-field">
                    <label for="deck-level" class="field-label">Poziom CEFR</label>
                    <select id="deck-level" name="cefr_level" class="field-select">
                        <?php foreach ($cefrLevels as $level): ?>
                            <option value="<?= htmlspecialchars((string) $level, ENT_QUOTES, 'UTF-8') ?>"<?= ($old['cefr_level'] ?? 'A1') === $level ? ' selected' : '' ?>>
                                <?= htmlspecialchars((string) $level, ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-field">
                    <label for="deck-status" class="field-label">Status</label>
                    <select id="deck-status" name="status" class="field-select">
                        <?php foreach ($statuses as $code => $label): ?>
                            <option value="<?= htmlspecialchars((string) $code, ENT_QUOTES, 'UTF-8') ?>"<?= ($old['status'] ?? 'published') === $code ? ' selected' : '' ?>>
                                <?= htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
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

    <?php if (!empty($deleteAction) && !empty($deleteCsrfToken)): ?>
        <section class="form-box form-danger-box" aria-labelledby="danger-zone-heading">
            <div class="danger-box-row">
                <div>
                    <h2 id="danger-zone-heading" class="form-box-title">Strefa niebezpieczna</h2>
                    <p class="card-meta">Usunięcie talii trwale usunie ją z bazy danych PostgreSQL.</p>
                </div>
                <form
                    method="post"
                    action="<?= htmlspecialchars((string) $deleteAction, ENT_QUOTES, 'UTF-8') ?>"
                    class="inline-action-form"
                    onsubmit="return confirm('Czy na pewno chcesz trwale usunąć tę talię?');"
                >
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars((string) $deleteCsrfToken, ENT_QUOTES, 'UTF-8') ?>">
                    <button type="submit" class="btn btn-outline btn-sm btn-danger-outline">Usuń talię</button>
                </form>
            </div>
        </section>
    <?php endif; ?>
</main>
