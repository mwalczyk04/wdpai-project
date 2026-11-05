<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="/css/style.css?v=2">
</head>
<body>
    <?php include __DIR__ . '/components/header.html.php'; ?>

    <main class="container main-content">
        <header class="page-header">
            <h1 class="page-title">Przeglądaj talie</h1>
            <p class="page-subtitle">Odkrywaj kolekcje fiszek do nauki języków</p>
        </header>

        <section class="catalog-toolbar" aria-label="Wyszukiwarka i filtry">
            <div class="search-wrapper">
                <input type="search" placeholder="Szukaj talii po słowie kluczowym..." class="search-input">
            </div>

            <div class="filters-row">
                <div class="filters-left">
                    <select class="filter-select" aria-label="Wybierz język">
                        <option value="">Wszystkie języki</option>
                        <option value="es">Hiszpański</option>
                        <option value="en">Angielski</option>
                        <option value="de">Niemiecki</option>
                        <option value="it">Włoski</option>
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

        <section class="deck-grid" aria-label="Lista talii">
            <article class="card">
                <header class="card-tags">
                    <span class="badge">ES</span>
                    <span class="badge">Level A1</span>
                </header>
                <h2 class="card-title">Spanish Basics</h2>
                <p class="card-meta">40 kart · Podstawowe zwroty</p>
                <a href="/decks/1" class="btn btn-outline">Ucz się</a>
            </article>

            <article class="card">
                <header class="card-tags">
                    <span class="badge">EN</span>
                    <span class="badge">Level B2</span>
                </header>
                <h2 class="card-title">Business English</h2>
                <p class="card-meta">75 kart · Negocjacje i prezentacje</p>
                <a href="/decks/2" class="btn btn-outline">Ucz się</a>
            </article>

            <article class="card">
                <header class="card-tags">
                    <span class="badge">EN</span>
                    <span class="badge">Level A2</span>
                </header>
                <h2 class="card-title">Travel Phrases</h2>
                <p class="card-meta">30 kart · Lotnisko i transport</p>
                <a href="/decks/3" class="btn btn-outline">Ucz się</a>
            </article>

            <article class="card">
                <header class="card-tags">
                    <span class="badge">DE</span>
                    <span class="badge">Level A1</span>
                </header>
                <h2 class="card-title">German Verbs</h2>
                <p class="card-meta">50 kart · Czasowniki nieregularne</p>
                <a href="/decks/1" class="btn btn-outline">Ucz się</a>
            </article>

            <article class="card">
                <header class="card-tags">
                    <span class="badge">IT</span>
                    <span class="badge">Level B1</span>
                </header>
                <h2 class="card-title">Italian Food & Dining</h2>
                <p class="card-meta">35 kart · Gastronomia i restauracja</p>
                <a href="/decks/1" class="btn btn-outline">Ucz się</a>
            </article>

            <article class="card">
                <header class="card-tags">
                    <span class="badge">ES</span>
                    <span class="badge">Level B2</span>
                </header>
                <h2 class="card-title">Subjunctive Mood</h2>
                <p class="card-meta">60 kart · Zaawansowana gramatyka</p>
                <a href="/decks/1" class="btn btn-outline">Ucz się</a>
            </article>
        </section>

        <nav class="pagination" aria-label="Paginacja">
            <a href="/decks" class="btn btn-outline" style="width: auto; padding: 0.4rem 0.8rem; font-size: 0.85rem;">← Poprzednia</a>
            <span class="pagination-info">Strona 1 z 4</span>
            <a href="/decks" class="btn btn-outline" style="width: auto; padding: 0.4rem 0.8rem; font-size: 0.85rem;">Następna →</a>
        </nav>
    </main>
</body>
</html>