<?php
  namespace app\controllers;
  use app\models\User;
  use app\Router;
  
  class UserController 
  {
    public $user = null;
    public function __construct()
    {
      $this->user = new User();
    }

    public function index(Router $router)
    {
      $dataUsers = $this->user->getAllData();
      $router->renderView('user/index', compact('dataUsers'));
    }

    public function create(Router $router)
    {
      $errors = [];
      $usersData = [
        'nama_user' => '',
        'username' => '',
        'password' => '',
        'level' => ''
      ];
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usersData['nama_user'] = $_POST['namalengkap'];
        $usersData['username'] = $_POST['username'];
        $usersData['password'] = $_POST['password'];
        $usersData['level'] = $_POST['leveluser'] ?? '';

        $this->user->load($usersData);
        $errors = $this->user->save();
        if (empty($errors)) {
          header('Location: /user');
          exit;
        }
      }
      $router->renderView('user/create', compact('usersData', 'errors'));
    }

    public function update(Router $router)
    {
      $id = $_GET['id'];
      if (!$id) {
        header('Location: /user');
        exit;
      }
      $usersData = $this->user->getDataById($id);
      $errors = [];
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usersData['nama_user'] = $_POST['namalengkap'];
        $usersData['username'] = $_POST['username'];
        $usersData['password'] = $_POST['password'];
        $usersData['level'] = $_POST['leveluser'] ?? '';

        $this->user->load($usersData);
        $errors = $this->user->save();
        if (empty($errors)) {
          header('Location: /user');
          exit;
        }
      }
      $router->renderView('user/update', compact('usersData'));
    }

    public function delete()
    {
      $id = $_POST['id'];
      if (!$id) {
        header('Location: /user');
        exit;
      }
      $this->user->deleteData($id);
      header('Location: /user');
    }    
  }