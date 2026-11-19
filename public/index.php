<?php

declare(strict_types=1);

use App\Controller\DeckController;
use App\Controller\DefaultController;
use App\Controller\ForumController;
use App\Controller\SecurityController;
use App\Database;
use App\Repository\DeckRepository;
use App\Routing;
use App\Service\CsrfService;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$database = new Database();
$csrfService = new CsrfService();

$routing = new Routing();
$routing->registerControllerFactory(
    DeckController::class,
    static fn (): DeckController => new DeckController(
        new DeckRepository($database->connect()),
        $csrfService,
    ),
);

// TU BĘDZIEMY DEFINIOWAĆ WSZYSTKIE TRASY WYSTĘPUJĄCE W NASZYM PROJEKCIE
$routing->get('/', DefaultController::class, 'index');
$routing->get('/decks', DeckController::class, 'index');
$routing->get('/decks/create', DeckController::class, 'create');
$routing->post('/decks/create', DeckController::class, 'create');
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