<?php
  namespace app\controllers;
  use app\models\Kategori;
  use app\Router;

  class KategoriController
  {
    public $kategori = null;
    public function __construct()
    {
      $this->kategori = new Kategori();
    }
    public function index(Router $router)
    {
      $kategories = $this->kategori->getAllData();
      // melakukan render view yang akan ditampilkan ('folder tujuan', data yang dikirmkan)
      $router->renderView('kategori/index', compact('kategories'));
    }
    
    public function create(Router $router)
    {
      $errors = [];
      $kategoriesData = [
        'nama_kategori' => ''
      ];
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $kategoriesData['nama'] = $_POST['namaKategori'];
        
        $this->kategori->load($kategoriesData);
        $errors = $this->kategori->save();
        if (empty($errors)) {
          header('Location: /kategori');
          exit;
        }
      }
      $router->renderView('kategori/create', compact('kategoriesData', 'errors'));
    }

    public function update(Router $router)
    {
      $id = $_GET['id'] ?? null;
      if (!$id) {
        header('Location: /kategori');
        exit;
      }
      $kategoriesData = $this->kategori->getDataById($id);
      $errors = [];
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $kategoriesData['nama'] = $_POST['namaKategori'];

        $this->kategori->load($kategoriesData);
        $errors = $this->kategori->save();
        if (empty($errors)) {
          header('Location: /kategori');
          exit;
        }
      }
      $router->renderView('kategori/create', compact('kategoriesData', 'errors'));
    }

    public function delete()
    {
      $id = $_POST['id'] ?? null;
      if (!$id) {
        header('Location: /kategori');
        exit;
      }
      $this->kategori->deleteData($id);
      header('Location: /kategori');
    }

  }
  