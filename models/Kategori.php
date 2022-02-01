<?php

  namespace app\models;
  use app\src\abstracts\Model;
  use app\Database;
  use PDO;

  class Kategori extends Model
  {
    public $db;
    public ?int $id = null;
    public ?string $namaKategori = null;
    public function __construct()
    {
      $this->db = new Database();
    }
    public function load($data)
    {
      $this->id = $data['id_kategori'] ?? null;
      $this->namaKategori = $data['nama'] ?? '';
    }
    public function save()
    {
      $errors = [];
      if (!$this->namaKategori) {
        $errors[] = 'Kategori tidak boleh kosong';
      }
      if (empty($errors)) {
        if ($this->id) {
          $this->updateData($this->id);
        } else {
          $this->storeData();
        }
      }
      return $errors;
    }
    public function getAllData()
    {
      $statement = $this->db->pdo->query("SELECT * FROM tbl_kategori");
      $statement->execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDataById($data)
    {
      $statement = $this->db->pdo->prepare("SELECT * FROM tbl_kategori WHERE id_kategori = :id");
      $statement->execute([
        'id' => $data
      ]);
      return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    public function storeData()
    {
      $statement = $this->db->pdo->prepare("INSERT INTO tbl_kategori (nama_kategori) VALUES(:kategori) ");
      $statement->execute([
        'kategori' => $this->namaKategori
      ]);
    }

    public function updateData($id)
    {
      $statement = $this->db->pdo->prepare("UPDATE tbl_kategori SET nama_kategori = :nama WHERE id_kategori = :id");
      $statement->execute([
        'nama' => $this->namaKategori,
        'id' => $this->id
      ]);
    }

    public function deleteData($id)
    {
      $statement = $this->db->pdo->prepare("DELETE FROM tbl_kategori WHERE id_kategori = :id");
      $statement->execute([
        'id' => $id
      ]);
    }
}
  