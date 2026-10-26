<?php

declare(strict_types=1);

namespace App\Controller;

final class DefaultController extends AppController
{
    public function index(): void
    {
        $this->render('home', [
            'pageTitle' => 'VocabHub — Pulpit',
            'userName' => 'Michał',
            'dueCardsCount' => 15,
        ]);
    }

    public function forum(): void
    {
        $this->render('forum', [
            'pageTitle' => 'VocabHub — Forum',
        ]);
    }

    public function notFound(): void
    {
        $this->render('not-found', [
            'pageTitle' => 'Nie znaleziono strony',
        ]);
    }
}