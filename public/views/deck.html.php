<?php

use App\Model\Deck;

/** @var Deck $deck */
$languageLabels = Deck::ALLOWED_LANGUAGES;
$statusLabels = Deck::ALLOWED_STATUSES;
$language = $deck->getLanguage();
$languageLabel = $languageLabels[$language] ?? strtoupper($language);
$status = $deck->getStatus();
$statusLabel = $statusLabels[$status] ?? $status;
$description = $deck->getDescription();
?>
<main class="container main-content">
    <div class="study-header">
        <div class="session-info">
            <a href="/decks" class="back-link">← Wróć do talii</a>
            <span>·</span>
            <strong><?= htmlspecialchars($deck->getTitle(), ENT_QUOTES, 'UTF-8') ?></strong>
            <span>(<?= htmlspecialchars($languageLabel, ENT_QUOTES, 'UTF-8') ?> · Level <?= htmlspecialchars($deck->getCefrLevel(), ENT_QUOTES, 'UTF-8') ?> · <?= htmlspecialchars($statusLabel, ENT_QUOTES, 'UTF-8') ?>)</span>
        </div>

        <nav class="mode-switch" aria-label="Tryb nauki">
            <button type="button" class="mode-btn active">Fiszki</button>
            <button type="button" class="mode-btn">Dopasowywanie</button>
        </nav>
    </div>

    <div class="study-area">
        <article class="flashcard" aria-label="Informacje o talii">
            <span class="flashcard-category">
                <?= htmlspecialchars(strtoupper($language), ENT_QUOTES, 'UTF-8') ?> · Level <?= htmlspecialchars($deck->getCefrLevel(), ENT_QUOTES, 'UTF-8') ?> · <?= htmlspecialchars($statusLabel, ENT_QUOTES, 'UTF-8') ?>
            </span>

            <div class="flashcard-body">
                <h1 class="flashcard-term"><?= htmlspecialchars($deck->getTitle(), ENT_QUOTES, 'UTF-8') ?></h1>
                <p class="card-meta"><?= htmlspecialchars($description !== null && $description !== '' ? $description : 'Brak opisu dla tej talii.', ENT_QUOTES, 'UTF-8') ?></p>
            </div>

            <button type="button" class="flip-prompt">Odwróć kartę (Spacja)</button>
        </article>

        <section class="rating-section" aria-label="Ocena zapamiętania słówka">
            <form action="/decks/<?= (int) $deck->getId() ?>" method="post" class="rating-grid">
                <button type="submit" name="rating" value="again" class="btn-rate btn-rate-again">Powtórz (1)</button>
                <button type="submit" name="rating" value="hard" class="btn-rate btn-rate-hard">Trudne (2)</button>
                <button type="submit" name="rating" value="good" class="btn-rate btn-rate-good">Dobre (3)</button>
                <button type="submit" name="rating" value="easy" class="btn-rate btn-rate-easy">Łatwe (4)</button>
            </form>
        </section>
    </div>
</main>
