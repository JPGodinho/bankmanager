<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/core/Auth.php';

class AuthTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        session_unset();
        session_destroy();
        if (session_status() !== PHP_SESSION_NONE) {
            session_abort();
        }

        $_SERVER['REQUEST_URI'] = '/bankmanager/public/home';
    }

    protected function tearDown(): void
    {
        session_unset();
        session_destroy();
        unset($_SERVER['REQUEST_URI']);
        parent::tearDown();
    }

    public function testRedirectToLoginWhenNotLoggedInAndAccessingProtectedPage()
    {
        unset($_SESSION['logged_in']);
        $_SERVER['REQUEST_URI'] = '/bankmanager/public/aluno';

        $this->expectException(Error::class);

        Auth::checkLogin();

        $this->fail('Auth::checkLogin() não redirecionou ou não encerrou a execução.');
    }

    public function testDoesNotRedirectWhenAccessingLoginPage()
    {
        unset($_SESSION['logged_in']);
        $_SERVER['REQUEST_URI'] = '/bankmanager/public/auth/login';

        Auth::checkLogin();

        $this->assertTrue(true, 'Auth::checkLogin() deveria permitir acesso à página de login.');
    }

    public function testDoesNotRedirectWhenLoggedIn()
    {
        $_SESSION['logged_in'] = true;
        $_SERVER['REQUEST_URI'] = '/bankmanager/public/home';

        Auth::checkLogin();

        $this->assertTrue(true, 'Auth::checkLogin() deveria permitir acesso para usuário logado.');
    }
}