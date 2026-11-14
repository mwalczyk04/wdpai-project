<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Handles community forum views and interactions.
 */
final class ForumController extends AppController
{
    /**
     * Render the forum view.
     */
    public function index(): void
    {
        $this->render('forum', [
            'pageTitle' => 'VocabHub — Forum',
            'styles' => ['/css/forum.css'],
        ]);
    }
}
