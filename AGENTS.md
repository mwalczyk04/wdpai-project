# AGENTS.md

## Cel projektu
Aplikacja webowa do nauki słownictwa języków obcych (fiszki, minigra, katalog talii i forum) napisana obiektowo w PHP 8.3 z samodzielną architekturą MVC, routingiem, uruchamiana w kontenerach Docker (Nginx, PHP-FPM).

## Struktura
- `public/index.php` — punkt wejścia aplikacji i rejestracja tras routera.
- `public/views/` — widoki HTML z fragmentami PHP (`*.html.php`).
- `public/css/` — modularne arkusze stylów (`style.css`, `study.css`, `deck-create.css`, `forum.css`).
- `src/Routing.php` — obiektowe dopasowanie tras i wywoływanie kontrolerów.
- `src/controllers/` — kontrolery w namespace `App\Controller` dziedziczące po `AppController`.

## Zasady pracy
- Obiektowość (OOP) to warunek krytyczny: brak kodu proceduralnego, pełna enkapsulacja, kontrolery muszą dziedziczyć po `AppController`.
- Zachowuj `declare(strict_types=1)` oraz jawne typowanie we wszystkich plikach PHP.
- Kontroler przygotowuje dane, a widok odpowiada wyłącznie za prezentację.
- Dane wyświetlane w HTML zabezpieczaj przez `htmlspecialchars()`.
- Nie dodawaj frameworków ani zależności zewnętrznych bez zgody.
- Wprowadzaj małe zmiany, zachowuj istniejący kod i nie modyfikuj plików niezwiązanych z zadaniem.
- Komunikaty commitów twórz w konwencji Conventional Commits (`feat:`, `fix:`, `chore:`).

## Uruchamianie i weryfikacja
- Start: `docker compose up -d`
- Składnia: `docker compose exec -T php php -l ścieżka/do/pliku.php`
- Autoloader: `docker compose exec -T php composer dump-autoload`
- Po zmianie trasy sprawdź poprawny adres oraz odpowiedź 404.
- Przed zakończeniem pokaż `git diff` i podsumuj zmienione pliki.

## Bezpieczeństwo
- Nie odczytuj ani nie commituj sekretów z `.env`.
- Nie wykonuj destrukcyjnych poleceń w terminalu bez potwierdzenia użytkownika.
- Nie edytuj ani nie usuwaj plików w `vendor/`.