<?php
  // mensetting namespace untuk Router
  namespace app;
  use app\Database;

  class Router  
  {
    public $db;

    public function __construct()
    {
      $this->db = new Database();
    }
    // attribute untuk class Router
    public $getRouter = [];
    public $postRouter = [];
    // method untuk menentukan get, berisi param (url tujuan, dan fungsi yg dijalnkan dalam controller)
    public function get($url, $fn)
    {
      // mengisi nilai getRouter dengan key url tujuan dengan value fungsi yang akan dijalankan
      $this->getRouter[$url] = $fn;
    }
    public function post($url, $fn)
    {
      $this->postRouter[$url] = $fn;
    }
    //method yang akan dijalankan sesuai dengan request yang masuk
    public function resolve()
    {
      // menentukan url sekarang/tujuan jika tidak ada set / <- index
      $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
      // menentukan apakah method yang sedang dijalankan get / post
      $method = $_SERVER['REQUEST_METHOD'];
      if ($method === 'GET') {
        // mengisi nilai $fn dengan fungsi dari key akan dijalankan 
        $fn = $this->getRouter[$currentUrl] ?? null;
      } else {
        $fn = $this->postRouter[$currentUrl] ?? null;
      }
      // jika url ditemukan jalankan perintah 
      if ($fn) {
        // menjalankan function berdasarkan request, dengan mengirimkan class Router
        call_user_func($fn, $this);
      } else {
        // echo "Page Not Found";
        include_once 'public/error.php';
      }
    }

    public function renderView($view, $params = [])
    {
      // array assoc dengan "key" dari view contoh products dan title dengan value masing" 
      foreach ($params as $key => $value) {
        // key dari array tadi akan di isi nilainya dari value masing" dengan variable variable (dynamic)
        $$key = $value;
      }
      // memulai output buffer untuk menyimpan data sebelum ditampilkan
      ob_start();
      // memasukan view yang akan ditampilkan lalu menyimpan apapiun data di dalamnya
      include_once __DIR__."/views/$view.php";
      // memasukan layout dan mengirim data content
      $content = ob_get_clean();
      // memasukan layout untuk templating
      if ($view == 'login/index') {
        include_once __DIR__.'/views/layouts/login.php';
      } else
      {
        include_once __DIR__.'/views/layouts/header.php';
      }
    }

  }
  