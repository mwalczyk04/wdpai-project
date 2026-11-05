<?php
$currentUri = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/');
?>
<header class="site-header">
    <div class="container header-content">
        <a href="/" class="logo">VocabHub</a>
        <nav aria-label="Główna nawigacja">
            <ul class="nav-links">
                <li><a href="/"<?= $currentUri === '/' ? ' aria-current="page"' : '' ?>>Pulpit</a></li>
                <li><a href="/decks"<?= str_starts_with($currentUri, '/decks') ? ' aria-current="page"' : '' ?>>Talie</a></li>
                <li><a href="/forum"<?= str_starts_with($currentUri, '/forum') ? ' aria-current="page"' : '' ?>>Forum</a></li>
            </ul>
        </nav>
        <div class="header-utils">
            <span>PL | EN</span>
            <button type="button" id="theme-toggle" class="theme-toggle" aria-label="Przełącz motyw">🌙</button>
            <span class="avatar-badge">MW</span>
        </div>
    </div>
</header>
