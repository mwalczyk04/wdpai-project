<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="/css/style.css?v=2">
    <link rel="stylesheet" href="/css/forum.css">
</head>
<body>
    <?php include __DIR__ . '/components/header.html.php'; ?>

    <main class="container main-content">
        <div class="forum-nav-bar">
            <nav class="breadcrumbs" aria-label="Okruszki chleba">
                <a href="/forum">Forum</a> > <span>Język angielski</span> > <span>Gramatyka</span>
            </nav>
            <a href="/decks" class="btn btn-outline" style="width: auto; font-size: 0.8125rem; padding: 0.35rem 0.75rem;">← Wróć do listy</a>
        </div>

        <article class="thread-card">
            <div class="author-meta">
                <span class="author-avatar">A</span>
                <div class="author-info">
                    <span class="author-name">Anna</span>
                    <span class="role-badge">Użytkownik</span>
                    <span>·</span>
                    <time class="post-time">2 godz. temu</time>
                </div>
            </div>

            <h1 class="question-title">Kiedy używać 'make', a kiedy 'do' w kontekście biznesowym?</h1>
            
            <p class="post-body">
                Cześć! Zawsze mylę 'make' i 'do' w zwrotach biznesowych (make a deal vs do business). Jaka jest ogólna reguła?
            </p>

            <div class="thread-tags">
                <span class="thread-tag">#business-english</span>
                <span class="thread-tag">#collocations</span>
            </div>

            <footer class="thread-actions">
                <span class="thread-stats">💬 12 odpowiedzi</span>
                <button type="button" class="btn btn-outline" style="width: auto; font-size: 0.8125rem; padding: 0.35rem 0.75rem;">Odpowiedz</button>
            </footer>
        </article>

        <section class="replies-section" aria-label="Odpowiedzi">
            <h2 class="replies-heading">Odpowiedzi (2)</h2>

            <article class="reply-card">
                <div class="author-meta">
                    <span class="author-avatar admin">TA</span>
                    <div class="author-info">
                        <span class="author-name">Tomasz_Admin</span>
                        <span class="role-badge admin">Admin</span>
                        <span>·</span>
                        <time class="post-time">1 godz. temu</time>
                    </div>
                </div>

                <p class="post-body">
                    Zasada: 'make' używamy do tworzenia i decyzji (make a profit, make a decision), a 'do' do rutynowych zadań i pracy (do market research, do your job).
                </p>

                <footer class="reply-footer">
                    <button type="button" class="btn-upvote" aria-label="Zagłosuj na tę odpowiedź">▲ 18</button>
                    <button type="button" class="btn btn-outline" style="width: auto; font-size: 0.75rem; padding: 0.25rem 0.5rem;">Odpowiedz</button>
                </footer>
            </article>

            <article class="reply-card">
                <div class="author-meta">
                    <span class="author-avatar">P</span>
                    <div class="author-info">
                        <span class="author-name">Piotr</span>
                        <span class="role-badge">Użytkownik</span>
                        <span>·</span>
                        <time class="post-time">45 min temu</time>
                    </div>
                </div>

                <p class="post-body">
                    Mnie pomaga nauka całych zwrotów zamiast pojedynczych słów. Dodaj je do talii i powtarzaj w krótkich zdaniach - łatwiej zapamiętasz, który czasownik pasuje.
                </p>

                <footer class="reply-footer">
                    <button type="button" class="btn-upvote" aria-label="Zagłosuj na tę odpowiedź">▲ 5</button>
                    <button type="button" class="btn btn-outline" style="width: auto; font-size: 0.75rem; padding: 0.25rem 0.5rem;">Odpowiedz</button>
                </footer>
            </article>
        </section>

        <section class="reply-editor-box" aria-label="Twoja odpowiedź">
            <h2 class="replies-heading">Twoja odpowiedź</h2>
            <textarea class="reply-textarea" placeholder="Napisz swoją odpowiedź..."></textarea>
            <div class="editor-actions">
                <button type="button" class="btn btn-primary">Opublikuj odpowiedź</button>
            </div>
        </section>
    </main>

</body>
</html>