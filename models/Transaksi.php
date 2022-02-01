<?php
  namespace app\models;
  use app\Database;
  use PDO;

  class Transaksi 
  {
    public $db;
    public function __construct()
    {
      $this->db = new Database();
    }
    public function getAllData($data)
    {
      $statement = $this->db->pdo->query("SELECT * from view_{$data}");
      $statement->execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
  }
  