<?php
  namespace app\controllers;
  use app\models\Login;
  use app\Router;

  class LoginController 
  {
    public $Login = null;
    public function __construct()
    {
      $this->Login = new Login();
    }
    public function index(Router $router)
    {
      $router->renderView('login/index');
    }
    public function login(Router $router)
    {
      $errors = [];
      $errors = $this->Login->load($_POST);
      if (empty($errors)) {
        $errors = $this->Login->login();
      }
      $router->renderView('login/index', compact('errors'));
    }
    public function logout()
    {
      session_unset();
      session_destroy();
      header('Location: /login');
    }
  }