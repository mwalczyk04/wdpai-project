<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-content">
            <a href="/" class="logo">VocabHub</a>
            <nav aria-label="Główna nawigacja">
                <ul class="nav-links">
                    <li><a href="/" aria-current="page">Pulpit</a></li>
                    <li><a href="/decks">Talie</a></li>
                    <li><a href="/forum">Forum</a></li>
                </ul>
            </nav>
            <div class="header-utils">
                <span>PL | EN</span>
                <button type="button" id="theme-toggle" class="theme-toggle" aria-label="Przełącz motyw">🌙</button>
                <span class="avatar-badge">MW</span>
            </div>
        </div>
    </header>

    <main class="container main-content">
        <section class="hero-card" aria-labelledby="welcome-heading">
            <span class="hero-tag">Codzienna powtórka</span>
            <h1 id="welcome-heading" class="hero-title">Cześć <?= htmlspecialchars($userName) ?>, gotowy do nauki?</h1>
            <p>Masz dzisiaj do powtórzenia <strong><?= (int) $dueCardsCount ?></strong> słówek.</p>
            <div>
                <a href="/decks/1" class="btn btn-primary">Rozpocznij powtórkę →</a>
            </div>
        </section>

        <section aria-labelledby="decks-heading">
            <header class="section-header">
                <h2 id="decks-heading" class="section-title">Twoje talie</h2>
                <a href="/decks/create" class="btn btn-outline" style="width: auto;">+ Utwórz talię</a>
            </header>

            <div class="deck-grid">
                <article class="card">
                    <header class="card-tags">
                        <span class="badge">ES</span>
                        <span class="badge">Level A1</span>
                    </header>
                    <h3 class="card-title">Spanish Basics</h3>
                    <p class="card-meta">40 kart · Podstawowe słownictwo</p>
                    <a href="/decks/1" class="btn btn-outline">Ucz się</a>
                </article>

                <article class="card">
                    <header class="card-tags">
                        <span class="badge">EN</span>
                        <span class="badge">Level B2</span>
                    </header>
                    <h3 class="card-title">Business English</h3>
                    <p class="card-meta">75 kart · Negocjacje i maile</p>
                    <a href="/decks/2" class="btn btn-outline">Ucz się</a>
                </article>

                <article class="card">
                    <header class="card-tags">
                        <span class="badge">EN</span>
                        <span class="badge">Level A2</span>
                    </header>
                    <h3 class="card-title">Travel Phrases</h3>
                    <p class="card-meta">30 kart · Podróże i lotnisko</p>
                    <a href="/decks/3" class="btn btn-outline">Ucz się</a>
                </article>
            </div>
        </section>

        <div class="bottom-grid">
            <section class="card" aria-labelledby="game-heading">
                <h2 id="game-heading" class="card-title">Szybka minigra</h2>
                <p class="card-meta">Dopasuj pary słówek i ich znaczeń w 2-minutowej rundzie.</p>
                <div>
                    <a href="/decks/1" class="btn btn-primary">Zagraj rundę</a>
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

</body>
</html>