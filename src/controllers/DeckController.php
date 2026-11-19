<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Deck;
use App\Repository\DeckRepositoryInterface;
use App\Service\CsrfService;
use PDOException;

/**
 * Handles deck catalog listing, detail display, creation, editing, and deletion.
 */
final class DeckController extends AppController
{
    private const string CREATE_CSRF_KEY = 'deck_create';
    private const string EDIT_CSRF_KEY = 'deck_edit';
    private const string DELETE_CSRF_KEY = 'deck_delete';

    public function __construct(
        private DeckRepositoryInterface $deckRepository,
        private CsrfService $csrfService,
    ) {
    }

    public function index(): void
    {
        $this->renderDecksList();
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
        $formConfig = $this->buildCreateFormConfig();

        if (!$this->isPost()) {
            $this->renderDeckForm($formConfig);
            return;
        }

        $formData = $this->handleFormPost($formConfig);
        if ($formData === null) {
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

        if (!$this->persistDeck($deck, $formConfig, $formData, isNew: true)) {
            return;
        }

        $this->redirect('/decks');
    }

    public function edit(int $id): void
    {
        $deck = $this->deckRepository->find($id);
        if ($deck === null) {
            $this->renderNotFound();
            return;
        }

        $formConfig = $this->buildEditFormConfig($deck);

        if (!$this->isPost()) {
            $this->renderDeckForm($formConfig, old: $this->extractDeckFields($deck));
            return;
        }

        $formData = $this->handleFormPost($formConfig);
        if ($formData === null) {
            return;
        }

        $deck->setTitle($formData['title']);
        $deck->setDescription($formData['description'] === '' ? null : $formData['description']);
        $deck->setLanguage($formData['language']);
        $deck->setCefrLevel($formData['cefr_level']);
        $deck->setStatus($formData['status']);

        if (!$this->persistDeck($deck, $formConfig, $formData, isNew: false)) {
            return;
        }

        $this->redirect('/decks/' . $id);
    }

    public function delete(int $id): void
    {
        if (!$this->hasValidCsrf(self::DELETE_CSRF_KEY)) {
            http_response_code(403);
            $deck = $this->deckRepository->find($id);
            $csrfMessage = 'Nieprawidłowy lub wygasły token bezpieczeństwa (CSRF). Odśwież formularz i spróbuj ponownie.';

            if ($deck !== null) {
                $this->renderDeckForm($this->buildEditFormConfig($deck), [$csrfMessage], $this->extractDeckFields($deck));
            } else {
                $this->renderDecksList([$csrfMessage]);
            }
            return;
        }

        $deck = $this->deckRepository->find($id);
        if ($deck === null) {
            $this->renderNotFound();
            return;
        }

        try {
            $this->deckRepository->delete($id);
        } catch (PDOException $exception) {
            error_log('Deck delete error: ' . $exception->getMessage());
            http_response_code(500);
            $this->renderDeckForm(
                $this->buildEditFormConfig($deck),
                ['Nie udało się usunąć talii z bazy danych. Spróbuj ponownie.'],
                $this->extractDeckFields($deck),
            );
            return;
        }

        $this->redirect('/decks');
    }

    /**
     * @return array{pageTitle: string, formHeading: string, formAction: string, cancelUrl: string, submitLabel: string, csrfKey: string, deleteAction: ?string}
     */
    private function buildCreateFormConfig(): array
    {
        return [
            'pageTitle' => 'Nowa talia',
            'formHeading' => 'Utwórz nową talię',
            'formAction' => '/decks/create',
            'cancelUrl' => '/decks',
            'submitLabel' => 'Zapisz talię',
            'csrfKey' => self::CREATE_CSRF_KEY,
            'deleteAction' => null,
        ];
    }

    /**
     * @return array{pageTitle: string, formHeading: string, formAction: string, cancelUrl: string, submitLabel: string, csrfKey: string, deleteAction: ?string}
     */
    private function buildEditFormConfig(Deck $deck): array
    {
        $deckId = (int) $deck->getId();

        return [
            'pageTitle' => 'Edytuj talię: ' . $deck->getTitle(),
            'formHeading' => 'Edytuj talię',
            'formAction' => '/decks/' . $deckId . '/edit',
            'cancelUrl' => '/decks/' . $deckId,
            'submitLabel' => 'Zapisz zmiany',
            'csrfKey' => self::EDIT_CSRF_KEY,
            'deleteAction' => '/decks/' . $deckId . '/delete',
        ];
    }

    /**
     * @return array{title: string, description: string, language: string, cefr_level: string, status: string}
     */
    private function extractDeckFields(Deck $deck): array
    {
        return [
            'title' => $deck->getTitle(),
            'description' => $deck->getDescription() ?? '',
            'language' => $deck->getLanguage(),
            'cefr_level' => $deck->getCefrLevel(),
            'status' => $deck->getStatus(),
        ];
    }

    /**
     * @param list<string> $errors
     */
    private function renderDecksList(array $errors = []): void
    {
        $this->render('decks', [
            'pageTitle' => 'Lista talii',
            'decks' => $this->deckRepository->findAll(),
            'errors' => $errors,
        ]);
    }

    private function hasValidCsrf(string $csrfKey): bool
    {
        $submittedToken = isset($_POST['csrf_token']) && is_string($_POST['csrf_token'])
            ? $_POST['csrf_token']
            : null;

        return $this->csrfService->validateToken($submittedToken, $csrfKey);
    }

    /**
     * @param array{pageTitle: string, formHeading: string, formAction: string, cancelUrl: string, submitLabel: string, csrfKey: string, deleteAction: ?string} $formConfig
     * @return array{title: string, description: string, language: string, cefr_level: string, status: string}|null
     */
    private function handleFormPost(array $formConfig): ?array
    {
        $formData = $this->extractFormData($_POST);

        if (!$this->hasValidCsrf($formConfig['csrfKey'])) {
            http_response_code(403);
            $this->renderDeckForm(
                $formConfig,
                ['Nieprawidłowy lub wygasły token bezpieczeństwa (CSRF). Odśwież formularz i spróbuj ponownie.'],
                $formData,
            );
            return null;
        }

        $errors = $this->validateDeckData($formData);
        if ($errors !== []) {
            http_response_code(422);
            $this->renderDeckForm($formConfig, $errors, $formData);
            return null;
        }

        return $formData;
    }

    /**
     * @param array{pageTitle: string, formHeading: string, formAction: string, cancelUrl: string, submitLabel: string, csrfKey: string, deleteAction: ?string} $formConfig
     * @param array{title: string, description: string, language: string, cefr_level: string, status: string} $formData
     */
    private function persistDeck(Deck $deck, array $formConfig, array $formData, bool $isNew): bool
    {
        try {
            if ($isNew) {
                $this->deckRepository->save($deck);
            } else {
                $this->deckRepository->update($deck);
            }

            return true;
        } catch (PDOException $exception) {
            error_log('Deck persistence error: ' . $exception->getMessage());
            http_response_code(500);
            $this->renderDeckForm(
                $formConfig,
                ['Nie udało się zapisać talii w bazie danych. Spróbuj ponownie.'],
                $formData,
            );
            return false;
        }
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
     * @param array{pageTitle: string, formHeading: string, formAction: string, cancelUrl: string, submitLabel: string, csrfKey: string, deleteAction: ?string} $formConfig
     * @param list<string> $errors
     * @param array{title?: string, description?: string, language?: string, cefr_level?: string, status?: string} $old
     */
    private function renderDeckForm(array $formConfig, array $errors = [], array $old = []): void
    {
        $defaults = [
            'title' => '',
            'description' => '',
            'language' => 'en',
            'cefr_level' => 'A1',
            'status' => 'published',
        ];

        $this->render('deck-form', [
            'pageTitle' => $formConfig['pageTitle'],
            'formHeading' => $formConfig['formHeading'],
            'formAction' => $formConfig['formAction'],
            'cancelUrl' => $formConfig['cancelUrl'],
            'submitLabel' => $formConfig['submitLabel'],
            'deleteAction' => $formConfig['deleteAction'],
            'deleteCsrfToken' => $formConfig['deleteAction'] !== null
                ? $this->csrfService->getToken(self::DELETE_CSRF_KEY)
                : null,
            'styles' => ['/css/deck-create.css'],
            'csrfToken' => $this->csrfService->getToken($formConfig['csrfKey']),
            'errors' => $errors,
            'old' => array_merge($defaults, $old),
            'languages' => Deck::ALLOWED_LANGUAGES,
            'cefrLevels' => Deck::ALLOWED_CEFR_LEVELS,
            'statuses' => Deck::ALLOWED_STATUSES,
        ]);
    }
}
