<?php
$currentUri = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/');
$isLoggedIn = !empty($currentUser ?? null);
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
            <button type="button" id="theme-toggle" class="theme-toggle" aria-label="Włącz ciemny motyw" aria-pressed="false" title="Zmień motyw">🌙</button>

            <?php if ($isLoggedIn): ?>
                <div class="user-menu-wrapper">
                    <button type="button" id="avatar-toggle" class="avatar-badge avatar-btn" aria-expanded="false" aria-haspopup="true" aria-label="Menu konta" title="Konto użytkownika">
                        <?= htmlspecialchars((string) ($userInitials ?? 'MW'), ENT_QUOTES, 'UTF-8') ?>
                    </button>

                    <div id="user-dropdown" class="user-dropdown" hidden>
                        <div class="user-profile-header">
                            <span class="user-profile-avatar"><?= htmlspecialchars((string) ($userInitials ?? 'MW'), ENT_QUOTES, 'UTF-8') ?></span>
                            <div class="user-profile-info">
                                <strong><?= htmlspecialchars((string) ($currentUser['name'] ?? 'Michał Walczyk'), ENT_QUOTES, 'UTF-8') ?></strong>
                                <small><?= htmlspecialchars((string) ($currentUser['email'] ?? 'michal@example.com'), ENT_QUOTES, 'UTF-8') ?></small>
                            </div>
                        </div>
                        <hr class="user-dropdown-divider">
                        <form method="post" action="/logout" class="logout-form">
                            <button type="submit" class="btn btn-outline btn-logout">Wyloguj się</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="header-auth-actions">
                    <a href="/login" class="btn btn-outline btn-sm">Zaloguj się</a>
                    <a href="/register" class="btn btn-primary btn-sm">Zarejestruj się</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>
