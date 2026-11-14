<?php

declare(strict_types=1);

namespace App\Controller;


final class SecurityController extends AppController
{
    public function login(): void
    {
        if ($this->isPost()) {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            var_dump($email, $password);

            $this->render('home', [
                'pageTitle' => 'VocabHub — Pulpit',
                'userName' => 'Michał',
                'dueCardsCount' => 15,
            ]);
            return;
        }

        $this->renderAuth('login', 'VocabHub — Logowanie');
    }


    public function register(): void
    {
        if ($this->isPost()) {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            var_dump($name, $email, $password, $confirmPassword);

            $this->renderAuth('login', 'VocabHub — Logowanie');
            return;
        }

        $this->renderAuth('register', 'VocabHub — Rejestracja');
    }

    
    public function logout(): void
    {
        if ($this->isPost()) {
            var_dump('logout');
        }

        $this->renderAuth('login', 'VocabHub — Logowanie');
    }

    
    private function renderAuth(string $template, string $pageTitle): void
    {
        $this->render($template, [
            'pageTitle' => $pageTitle,
            'styles' => ['/css/auth.css'],
            'hideHeader' => true,
        ]);
    }
}
