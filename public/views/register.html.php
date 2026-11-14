<main class="auth-page">
    <div class="auth-shell">
        <header class="auth-topbar">
            <a href="/" class="logo">VocabHub</a>
            <button type="button" id="theme-toggle" class="theme-toggle" aria-label="Włącz ciemny motyw" aria-pressed="false" title="Zmień motyw">🌙</button>
        </header>

        <section class="auth-card" aria-labelledby="register-heading">
            <div class="auth-header">
                <h1 id="register-heading" class="auth-title">Rejestracja</h1>
                <p class="auth-subtitle">Załóż konto i twórz własne talie fiszek</p>
            </div>

            <form id="register" method="post" action="/register" class="auth-form">
                <div class="form-group">
                    <label for="register-name" class="form-label"><i class="fa-solid fa-user" aria-hidden="true"></i> Imię lub nick:</label>
                    <input type="text" id="register-name" name="name" class="form-input" placeholder="Jan Kowalski" required autocomplete="name">
                </div>

                <div class="form-group">
                    <label for="register-email" class="form-label"><i class="fa-solid fa-at" aria-hidden="true"></i> Email:</label>
                    <input type="email" id="register-email" name="email" class="form-input" placeholder="twoj@email.pl" required autocomplete="email">
                </div>

                <div class="form-group">
                    <label for="register-password" class="form-label"><i class="fa-solid fa-key" aria-hidden="true"></i> Hasło:</label>
                    <input type="password" id="register-password" name="password" class="form-input" placeholder="••••••••" required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <label for="register-confirm-password" class="form-label"><i class="fa-solid fa-key" aria-hidden="true"></i> Potwierdź hasło:</label>
                    <input type="password" id="register-confirm-password" name="confirm_password" class="form-input" placeholder="••••••••" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Zarejestruj się</button>
            </form>

            <footer class="auth-footer">
                <p>Masz już konto? <a href="/login" class="auth-link">Zaloguj się</a></p>
            </footer>
        </section>
    </div>
</main>
