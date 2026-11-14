<?php

declare(strict_types=1);

use App\Controller\DeckController;
use App\Controller\DefaultController;
use App\Controller\ForumController;
use App\Controller\SecurityController;
use App\Routing;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$routing = new Routing();

// TU BĘDZIEMY DEFINIOWAĆ WSZYSTKIE TRASY WYSTĘPUJĄCE W NASZYM PROJEKCIE
$routing->get('/', DefaultController::class, 'index');
$routing->get('/decks', DeckController::class, 'index');
$routing->get('/decks/create', DeckController::class, 'create');
$routing->get('/decks/{id}', DeckController::class, 'show');
$routing->get('/forum', ForumController::class, 'index');
$routing->get('/login', SecurityController::class, 'login');
$routing->post('/login', SecurityController::class, 'login');
$routing->get('/register', SecurityController::class, 'register');
$routing->post('/register', SecurityController::class, 'register');
$routing->post('/logout', SecurityController::class, 'logout');

$routeFound = $routing->dispatch(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI'],
);

if (!$routeFound) {
    http_response_code(404);
    (new DefaultController())->notFound();
}