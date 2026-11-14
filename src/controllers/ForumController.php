<?php

declare(strict_types=1);

namespace App\Controller;


final class ForumController extends AppController
{
    public function index(): void
    {
        $this->render('forum', [
            'pageTitle' => 'VocabHub — Forum',
            'styles' => ['/css/forum.css'],
        ]);
    }
}
