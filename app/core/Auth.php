<?php

class Auth
{
    public static function checkLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $urlAtual = $_SERVER['REQUEST_URI'];

        if (
            (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true)
            && strpos($urlAtual, 'auth/login') === false
            && strpos($urlAtual, 'auth/authenticate') === false
        ) {
            header('Location: /bankmanager/public/auth/login');
            exit;
        }
    }
}
