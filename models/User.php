<?php
  namespace app\models;
  use app\src\abstracts\Model;
  use app\Database;
  use PDO;

  class User extends Model
  {
    public $db;
    public ?int $id = null;
    public ?string $namaUser = null;
    public ?string $username = null;
    public ?string $passwordUser = null;
    public ?string $level = null;

    public function __construct()
    {
      $this->db = new Database();
    }

    public function load($data)
    {
      $this->id = $data['id_user'] ?? null;
      $this->namaUser = $data['nama_user'] ?? '';
      $this->username = $data['username'] ?? '';
      $this->passwordUser = $data['password'] ?? '';
      $this->level = $data['level'] ?? '';
    }

    public function save()
    {
      $errors = [];
      if (!$this->namaUser) {
        $errors[] = "Nama tidak boleh kosong";
      }
      if (!$this->username) {
        $errors[] = "Username tidak boleh kosong";
      }
      if (!$this->passwordUser) {
        $errors[] = "Password tidak boleh kosong";
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
      $statement = $this->db->pdo->query("SELECT * FROM tbl_user");
      $statement->execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getDataById($data)
    {
      $statement = $this->db->pdo->prepare("SELECT * FROM tbl_user WHERE id_user = :id");
      $statement->execute([
        'id' => $data
      ]);
      return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function storeData()
    {
      $statement = $this->db->pdo->prepare("INSERT INTO tbl_user (nama_user, username, password, level) VALUES(:nama, :username, :password, :level) ");
      $statement->execute([
        'nama' => $this->namaUser,
        'username' => $this->username,
        'password' => $this->passwordUser,
        'level' => $this->level
      ]);
    }

    public function updateData($id)
    {
      $statement = $this->db->pdo->prepare("UPDATE tbl_user SET nama_user = :nama, username = :username, password = :password, level = :level WHERE id_user = :id");
      $statement->execute([
        'nama' => $this->namaUser,
        'username' => $this->username,
        'password' => $this->passwordUser,
        'level' => $this->level,
        'id' => $this->id
      ]);
    }

    public function deleteData($id)
    {
      $statement = $this->db->pdo->prepare("DELETE FROM tbl_user WHERE id_user = :id");
      $statement->execute([
        'id' => $id
      ]);
    }
  }