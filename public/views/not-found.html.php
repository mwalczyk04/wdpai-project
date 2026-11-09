<style>
    .not-found-page {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: var(--space-2);
    }

    .not-found-title {
        font-size: clamp(4rem, 10vw, 6.5rem);
        font-weight: 800;
        color: var(--color-brand);
        line-height: 1;
    }

    .not-found-desc {
        font-size: 1.25rem;
        color: var(--color-muted);
        margin-bottom: var(--space-2);
    }
</style>

<main class="container not-found-page">
    <h1 class="not-found-title">404</h1>
    <p class="not-found-desc">Nie znaleziono strony</p>
    <a href="/" class="btn btn-primary">Wróć do strony głównej</a>
</main>
