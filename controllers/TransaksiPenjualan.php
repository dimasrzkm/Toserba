<?php
  namespace app\controllers;
  use app\models\Penjualan;
  use app\Router;

  class TransaksiPenjualan 
  {
    public $Penjualan = null;
    public function __construct()
    {
      $this->Penjualan = new Penjualan();
    }
    public function create(Router $router)
    {
      $errors = [];
      $dataPenjualan = $this->Penjualan->load($_SESSION['id_user']);
      // $dataPenjualanBaru = [
      //   'id_penjualan' => '94',
      //   'id_user' => '1',
      //   'tanggal' => '2022-01-07 23:20:06'
      // ];
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->Penjualan->load($_SESSION['id_user']);
        $this->Penjualan->storeDataAndMove();
        $dataPenjualanBaru = $this->Penjualan->getDataById($_SESSION['id_user']);
        for ($i=1; $i < 6; $i++) { 
          $dataPenjualanBaru[$i] = $_POST['barang'][$i];
        }
        $this->Penjualan->loadForStore($dataPenjualanBaru);  
        $errors = $this->Penjualan->save();
        if (empty($errors)) {
          header('Location: /transaksi');
        }
      }
      // $dataPenjualan = $this->Penjualan->getDataById($_SESSION['id_user']);
      $router->renderView('penjualan/create', compact('dataPenjualan', 'errors'));
    }
  }