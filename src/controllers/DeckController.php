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
    ]);
    }
}