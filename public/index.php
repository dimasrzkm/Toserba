<?php
  session_start();
  // memasukan autoloading 
  require_once __DIR__.'../../vendor/autoload.php';
  // menggunakan Class yang diperlukan

  use app\api\getData;
  use app\controllers\UserController;
  use app\controllers\KategoriController;
  use app\controllers\BarangController;
  use app\controllers\LoginController;
  use app\controllers\TransaksiPenjualan;
  use app\controllers\TransaksiPembelian;
  use app\controllers\TransaksiController;
  use app\Router;
  // object dari instansiasi Router
  $router = new Router();
  // menggunakan method get yang ada dalam class Router, dengan params (tujuan, []->data yang dikirim)
  $router->get('/', [new BarangController, 'index']);
  $router->get('/api', [new getData, 'index']);
  // controller login
  $router->get('/login', [new LoginController, 'index']);
  $router->get('/logout', [new LoginController, 'logout']);
  $router->post('/login', [new LoginController, 'login']);

  $router->get('/kategori', [new KategoriController, 'index']);
  $router->get('/kategori/create', [new KategoriController, 'create']);
  $router->post('/kategori/create', [new KategoriController, 'create']);
  $router->get('/kategori/update', [new KategoriController, 'update']);
  $router->post('/kategori/update', [new KategoriController, 'update']);
  $router->post('/kategori/delete', [new KategoriController, 'delete']);
  
  $router->get('/barang', [new BarangController, 'index']);
  $router->get('/barang/create', [new BarangController, 'create']);
  $router->post('/barang/create', [new BarangController, 'create']);
  $router->get('/barang/update', [new BarangController, 'update']);
  $router->post('/barang/update', [new BarangController, 'update']);
  $router->post('/barang/delete', [new BarangController, 'delete']);

  if (@$_SESSION['level'] === 'Admin') {
    $router->get('/user', [new UserController, 'index']);
    $router->get('/user/create', [new UserController, 'create']);
    $router->post('/user/create', [new UserController, 'create']);
    $router->get('/user/update', [new UserController, 'update']);
    $router->post('/user/update', [new UserController, 'update']);
    $router->post('/user/delete', [new UserController, 'delete']);
  }

  $router->get('/transaksi', [new TransaksiController, 'index']);  
  
  $router->get('/penjualan/create', [new TransaksiPenjualan, 'create']);
  $router->post('/penjualan/create', [new TransaksiPenjualan, 'create']);
  
  $router->get('/pembelian/create', [new TransaksiPembelian, 'create']);
  $router->post('/pembelian/create', [new TransaksiPembelian, 'create']);
  
  // menjalankan path yang sesuai dengan request 
  $router->resolve();