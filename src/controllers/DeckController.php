<?php

declare(strict_types=1);

namespace App\Controller;

final class DeckController extends AppController
{
    public function index(): void
    {
        $this->render('decks', [
            'pageTitle' => 'Lista talii',
        ]);
    }

    public function show(int $id): void
    {
        $this->render('deck', [
            'pageTitle' => 'Szczegóły talii',
            'deckId' => $id,
            'styles' => ['/css/study.css'],
        ]);
    }

    public function create(): void
    {
        $this->render('deck-create', [
            'pageTitle' => 'Nowa talia',
            'styles' => ['/css/deck-create.css'],
        ]);
    }

    public function forum(): void
    {
        $this->render('forum', [
            'pageTitle' => 'Forum',
            'styles' => ['/css/forum.css'],
        ]);
    }
}
