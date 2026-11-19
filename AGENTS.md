# AGENTS.md

## Koncept projektu: VocabHub
Aplikacja webowa do nauki słownictwa języków obcych łącząca powtórki interwałowe (SRS), minigrę oraz forum społecznościowe, napisana obiektowo w PHP 8.3 (własne MVC i routing) w kontenerach Docker (Nginx, PHP-FPM, PostgreSQL).

### Główne ekrany i przepływy
1. **Pulpit (`/`):** podsumowanie postępów użytkownika, licznik fiszek do powtórki na dziś (SRS) i szybki powrót do ostatnich talii.
2. **Katalog talii (`/decks`):** przeglądanie talii publicznych i własnych, wyszukiwanie oraz filtrowanie (język, poziom CEFR A1–C2, sortowanie) przez Fetch API (JSON).
3. **Kreator i edycja talii (`/decks/create`, `/decks/{id}/edit`):** wybór języka i poziomu CEFR, dynamiczne dodawanie fiszek w JS (pojęcie, tłumaczenie, przykład) oraz opcjonalny upload okładki.
4. **Tryb nauki (`/decks/{id}/study`):**
   - **Fiszki (SRS):** odwracanie kart (mysz/klawiatura) i ocena trudności w skali 1–4 (*Powtórz*, *Trudne*, *Dobre*, *Łatwe*) zapisywana asynchronicznie (`POST` Fetch API).
   - **Minigra „Dopasowywanie”:** gra w czystym JS łącząca wylosowane pary pojęcie–tłumaczenie na czas, z obsługą błędów i ekranem wyniku.
5. **Forum społecznościowe (`/forum`):** tworzenie wątków dyskusyjnych, dodawanie odpowiedzi oraz głosowanie na pomocne wpisy (upvote’y).
6. **Autentykacja i ustawienia (`/login`, `/register`, profil):** rejestracja z e-mailem powitalnym, logowanie sesyjne, motyw `light`/`dark` (`data-theme` + `localStorage` + anty-FOUC) oraz tłumaczenia `PL | EN`.

### Role i uprawnienia
- **`USER`:** przeglądanie katalogu, tworzenie/edycja/usuwanie własnych talii i fiszek, nauka SRS, minigra, pisanie i głosowanie na forum.
- **`ADMIN`:** uprawnienia `USER` + moderacja wszystkich talii, wątków i postów oraz zarządzanie kontami.
- Uprawnienia weryfikuj zawsze po stronie backendu przed operacją (brak dostępu zwraca `401` lub `403`).

## Struktura
- `public/index.php` — punkt wejścia aplikacji i rejestracja tras routera.
- `public/views/` — wspólny układ `layout.html.php`, komponenty (`components/header.html.php`) oraz widoki podstron (`*.html.php`).
- `public/css/` — modularne arkusze stylów (`style.css`, `auth.css`, `deck-create.css`, `forum.css`, `study.css`) ze zmiennymi CSS.
- `public/js/` — skrypty frontendowe (`theme.js`, `user-menu.js`, docelowo moduły nauki, minigry i Fetch API).
- `src/Routing.php` — obiektowe dopasowanie tras (statyczne, regex, parametry `{id}`, query params) i wywoływanie kontrolerów.
- `src/controllers/` — kontrolery w namespace `App\Controller` dziedziczące po `AppController` (`DefaultController`, `DeckController`, `ForumController`, `SecurityController`).
- `src/models/`, `src/repositories/`, `src/services/` — encje domenowe, warstwa dostępu do danych (interfejsy DAO + PDO) i logika biznesowa.

## Zasady pracy
- Obiektowość (OOP) to warunek krytyczny: brak kodu proceduralnego, pełna enkapsulacja, kontrolery dziedziczą po `AppController`, repozytoria implementują interfejsy.
- Zachowuj `declare(strict_types=1)` oraz jawne typowanie we wszystkich plikach PHP.
- Kontroler obsługuje żądanie i deleguje logikę do serwisów/repozytoriów; widok odpowiada wyłącznie za prezentację.
- Dane wyświetlane w HTML zabezpieczaj przez `htmlspecialchars()`, zapytania SQL wykonuj wyłącznie przez *prepared statements* PDO, a formularze `POST` chroń tokenem CSRF.
- Nie dodawaj frameworków ani zależności zewnętrznych bez zgody.
- Wprowadzaj małe zmiany, zachowuj istniejący kod i nie modyfikuj plików niezwiązanych z zadaniem.
- Komunikaty commitów twórz w konwencji Conventional Commits (`feat:`, `fix:`, `refactor:`, `chore:`, `docs:`).

## Uruchamianie i weryfikacja
- Start: `docker compose up -d`
- Składnia: `docker compose exec -T php php -l ścieżka/do/pliku.php`
- Autoloader: `docker compose exec -T php composer dump-autoload`
- Po zmianie trasy sprawdź poprawny adres oraz odpowiedź 404.
- Przed zakończeniem pokaż `git diff` i podsumuj zmienione pliki.

## Bezpieczeństwo
- Nie odczytuj ani nie commituj sekretów z `.env` (utrzymuj aktualny `.env.example`).
- Nie wykonuj destrukcyjnych poleceń w terminalu bez potwierdzenia użytkownika.
- Nie edytuj ani nie usuwaj plików w `vendor/`.