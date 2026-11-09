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

            <div class="user-menu-wrapper">
                <button type="button" id="avatar-toggle" class="avatar-badge avatar-btn" aria-expanded="false" aria-haspopup="true" aria-label="Menu konta" title="Konto użytkownika">
                    <?= htmlspecialchars($userInitials ?? 'MW') ?>
                </button>

                <div id="user-dropdown" class="user-dropdown" style="position: absolute; right: 0; top: calc(100% + 0.75rem); z-index: 1000;" hidden>
                    <?php if ($isLoggedIn): ?>
                        <div class="user-profile-header">
                            <span class="user-profile-avatar"><?= htmlspecialchars($userInitials ?? 'MW') ?></span>
                            <div class="user-profile-info">
                                <strong><?= htmlspecialchars($currentUser['name'] ?? 'Michał Walczyk') ?></strong>
                                <small><?= htmlspecialchars($currentUser['email'] ?? 'michal@example.com') ?></small>
                            </div>
                        </div>
                        <hr class="user-dropdown-divider">
                        <form method="post" action="/logout" class="logout-form">
                            <button type="submit" class="btn btn-outline btn-logout">Wyloguj się</button>
                        </form>
                    <?php else: ?>
                        <form id="login" method="post" action="/login" class="login-form">
                            <div class="login-header">
                                <h2 class="login-title">Logowanie</h2>
                                <p class="login-subtitle">Wprowadź dane, aby się zalogować</p>
                            </div>
                            <div class="form-group">
                                <label for="login-email" class="form-label"><i class="fa-solid fa-at"></i> Email:</label>
                                <input type="email" id="login-email" name="email" class="form-input" placeholder="twoj@email.pl" required autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="login-password" class="form-label"><i class="fa-solid fa-key"></i> Hasło:</label>
                                <input type="password" id="login-password" name="password" class="form-input" placeholder="••••••••" required autocomplete="current-password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Zaloguj się</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
