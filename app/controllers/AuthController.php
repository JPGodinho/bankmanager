<?php

class AuthController extends Controller{

    public function login(){
        $this->view('auth/login');
    }

    public function authenticate(){
        session_start();

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if($email == "admin@admin.com" && $password == "123456"){
            $_SESSION['logged_in'] = true;
            header('Location: bankmanager/public/home');
            exit;
        } else {
            $_SESSION['error'] = 'Email ou senha inválidos';
            header('Location: bankmanager/public/auth/login');
            exit;
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: bankmanager/public/auth/login');
        exit;
    }

    public function index(){
    header('Location: /bankmanager/public/home');
    exit;
    }
}