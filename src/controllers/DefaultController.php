<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\DeckRepositoryInterface;

/**
 * Handles the home dashboard and fallback 404 view.
 */
final class DefaultController extends AppController
{
    public function __construct(private DeckRepositoryInterface $deckRepository)
    {
    }

    public function index(): void
    {
        $recentDecks = $this->deckRepository->findRecent(6);

        $this->render('home', [
            'pageTitle' => 'VocabHub — Pulpit',
            'userName' => 'Michał',
            'dueCardsCount' => 15,
            'recentDecks' => $recentDecks,
        ]);
    }

    public function notFound(): void
    {
        $this->renderNotFound();
    }
}
