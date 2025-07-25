<?php

require_once __DIR__ . '/../core/Auth.php';
Auth::checkLogin();


class HomeController extends Controller {

    public function index() {
        $this->view('home/index');
    }
}