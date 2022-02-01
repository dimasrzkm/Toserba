<?php

  namespace app;
  use PDO;

  class Database 
  {
    // menggunakan instance dari class PDO
    public PDO $pdo;
    // public static Database $db;

    public function __construct()
    {
      // pembuatan koneksi ke database
      $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=db_sembako', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
      // menginisialisasi kelas sendiri
      // self::$db = $this;
    }
  }
  