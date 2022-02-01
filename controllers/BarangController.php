<?php
  namespace app\controllers;
  use app\models\Barang;
  use app\Router;

  class BarangController
  {
    // mendefinisikan property dari class Barang
    public $barang = null;
    public function __construct()
    {
      // membuat object baru dan disimpan pada property barang
      $this->barang = new Barang();
    }
    public function index(Router $router)
    {
      $dataBarang = $this->barang->getAllData();
      $router->renderView('barang/index', compact('dataBarang'));
    }
    public function create(Router $router)
    {
      $errors = [];
      $dataBarang = [
        'id_barang' => '',
        'nama_barang' => '',
        'harga_barang' => '',
        'gambar' => '',
        'stok' => '0',
        'satuan' => '',
        'id_kategori' => ''
      ];
      if ($_SERVER['REQUEST_METHOD'] === 'POST')
      {
        $dataBarang['nama_barang'] = $_POST['namabarang'];
        $dataBarang['harga_barang'] = (float) $_POST['hargabarang'];
        $dataBarang['satuan'] = $_POST['satuanbarang'] ?? '';
        $dataBarang['id_kategori'] = $_POST['idkategori'] ?? null;
        $dataBarang['gambarFile'] = $_FILES['gambarbarang'] ?? null;

        $this->barang->load($dataBarang);
        $errors = $this->barang->save();
        if (empty($errors)) {
          header('Location: /barang');
          exit;
        }
      }
      $router->renderView('barang/create', compact('dataBarang', 'errors'));
    }
    public function update(Router $router)
    {
      $id = $_GET['id'];
      if (!$id) {
        header('Location: /barang');
        exit;
      }
      $dataBarang = $this->barang->getDataById($id);
      $errors = [];
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $dataBarang['nama_barang'] = $_POST['namabarang'];
        $dataBarang['harga_barang'] = (float) $_POST['hargabarang'];
        $dataBarang['satuan'] = $_POST['satuanbarang'];
        $dataBarang['id_kategori'] = $_POST['idkategori'] ?? null;
        $dataBarang['gambarFile'] = $_FILES['gambarbarang'] ?? null;

        $this->barang->load($dataBarang);
        $errors = $this->barang->save();
        if (empty($errors)) {
          header('Location: /barang');
        }
      }
      $router->renderView('barang/update', compact('dataBarang', 'errors'));
    }
    public function delete()
    {
      $id = $_POST['id'];
      if (!$id) {
        header('Location: /barang');
        exit;
      }
      $this->barang->deleteData($id);
      header('Location: /barang');
    }
  }