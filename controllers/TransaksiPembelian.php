<?php
  namespace app\controllers;
  use app\models\Pembelian;
  use app\Router;

class TransaksiPembelian
  {
    public $Pembelian = null;
    public function __construct()
    {
      $this->Pembelian = new Pembelian();
    }
    public function create(Router $router)
    {
      $errors = [];
      $dataPembelian = $this->Pembelian->load($_SESSION['id_user']);
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->Pembelian->load($_SESSION['id_user']);
        $this->Pembelian->storeDataAndMove();
        $dataPembelianBaru = $this->Pembelian->getDataById($_SESSION['id_user']);
        for ($i=1; $i < 6; $i++) { 
          $dataPembelianBaru[$i] = $_POST['barang'][$i];
        }
        $this->Pembelian->loadForStore($dataPembelianBaru);  
        $errors = $this->Pembelian->save();
        if (empty($errors)) {
          header('Location: /transaksi');
        }
      }
      $router->renderView('pembelian/create', compact('dataPembelian', 'errors'));
    }
  }