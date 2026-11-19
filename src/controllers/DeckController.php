<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Deck;
use App\Repository\DeckRepositoryInterface;
use App\Service\CsrfService;
use PDOException;

/**
 * Handles deck catalog listing and creation workflows.
 */
final class DeckController extends AppController
{
    private const string CREATE_CSRF_KEY = 'deck_create';

    public function __construct(
        private DeckRepositoryInterface $deckRepository,
        private CsrfService $csrfService,
    ) {
    }

    public function index(): void
    {
        $decks = $this->deckRepository->findAll();

        $this->render('decks', [
            'pageTitle' => 'Lista talii',
            'decks' => $decks,
        ]);
    }

    public function show(int $id): void
    {
        $deck = $this->deckRepository->find($id);
        if ($deck === null) {
            $this->renderNotFound();
            return;
        }

        $this->render('deck', [
            'pageTitle' => $deck->getTitle() . ' — Szczegóły talii',
            'deck' => $deck,
            'styles' => ['/css/study.css'],
        ]);
    }

    public function create(): void
    {
        if (!$this->isPost()) {
            $this->renderCreateForm();
            return;
        }

        $formData = $this->extractFormData($_POST);
        $submittedToken = isset($_POST['csrf_token']) && is_string($_POST['csrf_token'])
            ? $_POST['csrf_token']
            : null;

        if (!$this->csrfService->validateToken($submittedToken, self::CREATE_CSRF_KEY)) {
            http_response_code(403);
            $this->renderCreateForm(
                ['Nieprawidłowy lub wygasły token bezpieczeństwa (CSRF). Odśwież formularz i spróbuj ponownie.'],
                $formData,
            );
            return;
        }

        $errors = $this->validateDeckData($formData);
        if ($errors !== []) {
            http_response_code(422);
            $this->renderCreateForm($errors, $formData);
            return;
        }

        $deck = new Deck(
            null,
            $formData['title'],
            $formData['description'] === '' ? null : $formData['description'],
            $formData['language'],
            $formData['cefr_level'],
            $formData['status'],
        );

        try {
            $this->deckRepository->save($deck);
        } catch (PDOException $exception) {
            error_log('Deck save error: ' . $exception->getMessage());
            http_response_code(500);
            $this->renderCreateForm(
                ['Nie udało się zapisać talii w bazie danych. Spróbuj ponownie.'],
                $formData,
            );
            return;
        }

        $this->redirect('/decks');
    }

    /**
     * @param array<string, mixed> $input
     * @return array{title: string, description: string, language: string, cefr_level: string, status: string}
     */
    private function extractFormData(array $input): array
    {
        return [
            'title' => trim((string) ($input['title'] ?? '')),
            'description' => trim((string) ($input['description'] ?? '')),
            'language' => trim((string) ($input['language'] ?? 'en')),
            'cefr_level' => trim((string) ($input['cefr_level'] ?? 'A1')),
            'status' => trim((string) ($input['status'] ?? 'published')),
        ];
    }

    /**
     * @param array{title: string, description: string, language: string, cefr_level: string, status: string} $data
     * @return list<string>
     */
    private function validateDeckData(array $data): array
    {
        $errors = [];

        if ($data['title'] === '') {
            $errors[] = 'Tytuł talii jest wymagany.';
        } elseif (mb_strlen($data['title']) > 150) {
            $errors[] = 'Tytuł talii może mieć maksymalnie 150 znaków.';
        }

        if (!array_key_exists($data['language'], Deck::ALLOWED_LANGUAGES)) {
            $errors[] = 'Wybrano nieprawidłowy język.';
        }

        if (!in_array($data['cefr_level'], Deck::ALLOWED_CEFR_LEVELS, true)) {
            $errors[] = 'Wybrano nieprawidłowy poziom CEFR.';
        }

        if (!array_key_exists($data['status'], Deck::ALLOWED_STATUSES)) {
            $errors[] = 'Wybrano nieprawidłowy status talii.';
        }

        return $errors;
    }

    /**
     * @param list<string> $errors
     * @param array{title: string, description: string, language: string, cefr_level: string, status: string} $old
     */
    private function renderCreateForm(array $errors = [], array $old = []): void
    {
        $defaults = [
            'title' => '',
            'description' => '',
            'language' => 'en',
            'cefr_level' => 'A1',
            'status' => 'published',
        ];

        $this->render('deck-create', [
            'pageTitle' => 'Nowa talia',
            'styles' => ['/css/deck-create.css'],
            'csrfToken' => $this->csrfService->getToken(self::CREATE_CSRF_KEY),
            'errors' => $errors,
            'old' => array_merge($defaults, $old),
            'languages' => Deck::ALLOWED_LANGUAGES,
            'cefrLevels' => Deck::ALLOWED_CEFR_LEVELS,
            'statuses' => Deck::ALLOWED_STATUSES,
        ]);
    }
}
