<?php
  namespace app\controllers;
  use app\models\Transaksi;  
  use app\Router;

  class TransaksiController 
  {
    public $Transaksi;
    public function __construct()
    {
      $this->Transaksi = new Transaksi();
    }
    public function index(Router $router)
    {
      $dataPenjualan = $this->Transaksi->getAllData("detail_penjualan");
      $dataPembelian = $this->Transaksi->getAllData("detail_pembelian");
      $router->renderView('transaksi/index', compact('dataPenjualan', 'dataPembelian'));
    }
  }
