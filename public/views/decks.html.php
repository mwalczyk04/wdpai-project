<?php

use App\Model\Deck;

$decks = is_array($decks ?? null) ? $decks : [];
$statusLabels = Deck::ALLOWED_STATUSES;
$languageLabels = Deck::ALLOWED_LANGUAGES;
?>
<main class="container main-content">
    <header class="page-header page-header-row">
        <div>
            <h1 class="page-title">Przeglądaj talie</h1>
            <p class="page-subtitle">Odkrywaj kolekcje fiszek do nauki języków</p>
        </div>
        <a href="/decks/create" class="btn btn-primary">+ Utwórz talię</a>
    </header>

    <section class="catalog-toolbar" aria-label="Wyszukiwarka i filtry">
        <div class="search-wrapper">
            <input type="search" placeholder="Szukaj talii po słowie kluczowym..." class="search-input" aria-label="Szukaj talii po słowie kluczowym">
        </div>

        <div class="filters-row">
            <div class="filters-left">
                <select class="filter-select" aria-label="Wybierz język">
                    <option value="">Wszystkie języki</option>
                    <option value="es">Hiszpański</option>
                    <option value="en">Angielski</option>
                    <option value="de">Niemiecki</option>
                    <option value="it">Włoski</option>
                    <option value="fr">Francuski</option>
                </select>

                <div class="level-group" role="group" aria-label="Filtruj po poziomie trudności">
                    <button type="button" class="level-btn active">Wszystkie</button>
                    <button type="button" class="level-btn">A1</button>
                    <button type="button" class="level-btn">A2</button>
                    <button type="button" class="level-btn">B1</button>
                    <button type="button" class="level-btn">B2</button>
                </div>
            </div>

            <div class="filters-right">
                <select class="filter-select" aria-label="Sortowanie">
                    <option value="popular">Najpopularniejsze</option>
                    <option value="newest">Najnowsze</option>
                    <option value="alphabetical">Alfabetycznie</option>
                </select>
            </div>
        </div>
    </section>

    <?php if ($decks === []): ?>
        <section class="card empty-state" aria-label="Brak talii">
            <h2 class="card-title">Brak zapisanych talii w bazie</h2>
            <p class="card-meta">Utwórz pierwszą talię fiszek, aby zapisać ją w PostgreSQL.</p>
            <div>
                <a href="/decks/create" class="btn btn-primary">+ Utwórz pierwszą talię</a>
            </div>
        </section>
    <?php else: ?>
        <section class="deck-grid" aria-label="Lista talii">
            <?php foreach ($decks as $deck): ?>
                <?php
                $status = $deck->getStatus();
                $statusLabel = $statusLabels[$status] ?? $status;
                $statusClass = match ($status) {
                    'published' => 'badge-status-published',
                    'draft' => 'badge-status-draft',
                    'archived' => 'badge-status-archived',
                    default => '',
                };
                $language = $deck->getLanguage();
                $languageLabel = $languageLabels[$language] ?? strtoupper($language);
                $description = $deck->getDescription();
                ?>
                <article class="card">
                    <header class="card-tags">
                        <span class="badge"><?= htmlspecialchars(strtoupper($language), ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="badge">Level <?= htmlspecialchars($deck->getCefrLevel(), ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="badge badge-status <?= $statusClass ?>"><?= htmlspecialchars($statusLabel, ENT_QUOTES, 'UTF-8') ?></span>
                    </header>
                    <h2 class="card-title"><?= htmlspecialchars($deck->getTitle(), ENT_QUOTES, 'UTF-8') ?></h2>
                    <p class="card-meta">
                        <?= htmlspecialchars($languageLabel, ENT_QUOTES, 'UTF-8') ?> ·
                        <?= htmlspecialchars($description !== null && $description !== '' ? $description : 'Brak opisu', ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <a href="/decks/<?= (int) $deck->getId() ?>" class="btn btn-outline">Ucz się</a>
                </article>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <nav class="pagination" aria-label="Podsumowanie listy">
        <span class="pagination-info">Łącznie talii: <?= count($decks) ?></span>
    </nav>
</main>
