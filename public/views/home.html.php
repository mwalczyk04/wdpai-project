<?php

use App\Model\Deck;

$recentDecks = is_array($recentDecks ?? null) ? $recentDecks : [];
$languageLabels = Deck::ALLOWED_LANGUAGES;
$statusLabels = Deck::ALLOWED_STATUSES;

$primaryDeck = null;
foreach ($recentDecks as $candidate) {
    if ($candidate instanceof Deck && $candidate->getStatus() === 'published') {
        $primaryDeck = $candidate;
        break;
    }
}
if ($primaryDeck === null && isset($recentDecks[0]) && $recentDecks[0] instanceof Deck) {
    $primaryDeck = $recentDecks[0];
}

$primaryStudyUrl = $primaryDeck instanceof Deck ? '/decks/' . (int) $primaryDeck->getId() : '/decks/create';
$primaryStudyLabel = $primaryDeck instanceof Deck ? 'Rozpocznij powtórkę →' : 'Utwórz pierwszą talię →';
$minigameUrl = $primaryDeck instanceof Deck ? '/decks/' . (int) $primaryDeck->getId() : '/decks';
?>
<main class="container main-content">
    <section class="hero-card" aria-labelledby="welcome-heading">
        <span class="hero-tag">Codzienna powtórka</span>
        <h1 id="welcome-heading" class="hero-title">Cześć <?= htmlspecialchars((string) ($userName ?? 'Gość'), ENT_QUOTES, 'UTF-8') ?>, gotowy do nauki?</h1>
        <p>Masz dzisiaj do powtórzenia <strong><?= (int) ($dueCardsCount ?? 0) ?></strong> słówek.</p>
        <div>
            <a href="<?= htmlspecialchars($primaryStudyUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary"><?= htmlspecialchars($primaryStudyLabel, ENT_QUOTES, 'UTF-8') ?></a>
        </div>
    </section>

    <section aria-labelledby="decks-heading">
        <header class="section-header">
            <h2 id="decks-heading" class="section-title">Twoje talie</h2>
            <a href="/decks/create" class="btn btn-outline" style="width: auto;">+ Utwórz talię</a>
        </header>

        <?php if ($recentDecks === []): ?>
            <article class="card empty-state">
                <h3 class="card-title">Brak zapisanych talii</h3>
                <p class="card-meta">Utwórz pierwszą talię, aby pojawiła się na Twoim pulpicie.</p>
                <div>
                    <a href="/decks/create" class="btn btn-primary">+ Utwórz talię</a>
                </div>
            </article>
        <?php else: ?>
            <div class="deck-grid">
                <?php foreach ($recentDecks as $deck): ?>
                    <?php
                    $deckId = (int) $deck->getId();
                    $language = $deck->getLanguage();
                    $languageLabel = $languageLabels[$language] ?? strtoupper($language);
                    $status = $deck->getStatus();
                    $statusLabel = $statusLabels[$status] ?? $status;
                    $statusClass = match ($status) {
                        'published' => 'badge-status-published',
                        'draft' => 'badge-status-draft',
                        'archived' => 'badge-status-archived',
                        default => '',
                    };
                    $description = $deck->getDescription();
                    ?>
                    <article class="card">
                        <header class="card-tags">
                            <span class="badge"><?= htmlspecialchars(strtoupper($language), ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="badge">Level <?= htmlspecialchars($deck->getCefrLevel(), ENT_QUOTES, 'UTF-8') ?></span>
                            <div class="card-tag-actions">
                                <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($statusLabel, ENT_QUOTES, 'UTF-8') ?></span>
                                <a
                                    href="/decks/<?= $deckId ?>/edit"
                                    class="card-edit-link"
                                    aria-label="Edytuj talię <?= htmlspecialchars($deck->getTitle(), ENT_QUOTES, 'UTF-8') ?>"
                                    title="Edytuj talię"
                                >
                                    <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                                </a>
                            </div>
                        </header>
                        <h3 class="card-title"><?= htmlspecialchars($deck->getTitle(), ENT_QUOTES, 'UTF-8') ?></h3>
                        <p class="card-meta">
                            <?= htmlspecialchars($languageLabel, ENT_QUOTES, 'UTF-8') ?> ·
                            <?= htmlspecialchars($description !== null && $description !== '' ? $description : 'Brak opisu', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <a href="/decks/<?= $deckId ?>" class="btn btn-outline card-study-btn">Ucz się</a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <div class="bottom-grid">
        <section class="card" aria-labelledby="game-heading">
            <h2 id="game-heading" class="card-title">Szybka minigra</h2>
            <p class="card-meta">Dopasuj pary słówek i ich znaczeń w 2-minutowej rundzie.</p>
            <div>
                <a href="<?= htmlspecialchars($minigameUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-primary">Zagraj rundę</a>
            </div>
        </section>

        <section class="card" aria-labelledby="forum-heading">
            <h2 id="forum-heading" class="card-title">Aktywność na forum</h2>
            <ul class="forum-preview-list">
                <li>
                    <a href="/forum" class="forum-link">Kiedy używać "make", a kiedy "do"?</a>
                    <small style="color: var(--color-muted);">8 odpowiedzi · 2 godz. temu</small>
                </li>
            </ul>
        </section>
    </div>
</main>
