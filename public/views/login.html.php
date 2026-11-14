<main class="auth-page">
    <div class="auth-shell">
        <header class="auth-topbar">
            <a href="/" class="logo">VocabHub</a>
            <button type="button" id="theme-toggle" class="theme-toggle" aria-label="Włącz ciemny motyw" aria-pressed="false" title="Zmień motyw">🌙</button>
        </header>

        <section class="auth-card" aria-labelledby="login-heading">
            <div class="auth-header">
                <h1 id="login-heading" class="auth-title">Logowanie</h1>
                <p class="auth-subtitle">Wprowadź swoje dane, aby kontynuować naukę</p>
            </div>

            <form id="login" method="post" action="/login" class="auth-form">
                <div class="form-group">
                    <label for="login-email" class="form-label"><i class="fa-solid fa-at" aria-hidden="true"></i> Email:</label>
                    <input type="email" id="login-email" name="email" class="form-input" placeholder="twoj@email.pl" required autocomplete="email">
                </div>

                <div class="form-group">
                    <label for="login-password" class="form-label"><i class="fa-solid fa-key" aria-hidden="true"></i> Hasło:</label>
                    <input type="password" id="login-password" name="password" class="form-input" placeholder="••••••••" required autocomplete="current-password">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Zaloguj się</button>
            </form>

            <footer class="auth-footer">
                <p>Nie masz jeszcze konta? <a href="/register" class="auth-link">Zarejestruj się</a></p>
            </footer>
        </section>
    </div>
</main>
