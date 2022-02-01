<?php
  namespace app\models;
  use app\src\abstracts\Model;
  use app\Database;
  use PDO;

  class Penjualan extends Model
  {
    public $db;
    public ?int $id = null;
    public ?string $tanggal = null;
    public ?array $barang;

    public function __construct()
    {
      $this->db = new Database();
    }
    public function save()
    {
      $errors = [];
      if (empty($this->id)) {
        array_push($errors,'ID tidak boleh kosong');
      }
      if (empty($this->barang)) {
        array_push($errors,'Nama barang tidak boleh kosong');
      }
      if (empty($errors)) {
        if ($this->id) {
          $this->storeData();
          // $this->updateData($this->id);
        } else {
          $this->storeData();
        }
      }
      return $errors;
    }
    public function load($data)
    {
      $this->id =  $data;
      $this->tanggal = date('Y-m-d H:i:s');
      return $this->getDataLimit();
    }
    public function loadForStore($data)
    {
      $this->id =  $data['id_penjualan'] ?? null;
      $this->tanggal = $data['tanggal'] ?? null;
      for ($i=1; $i < 6; $i++) { 
        if (($data[$i]['harga'] !== "") && ($data[$i]['jumlah'] !== "")) {
          $this->barang[] = $data[$i];
        }
      }
    }
    public function getAllData()
    {

    }
    public function getDataLimit()
    {
      $statement = $this->db->pdo->query("SELECT * FROM tbl_penjualan ORDER BY id_penjualan DESC LIMIT 1");
      if ($statement->rowCount() === 0) {
        return ['id_penjualan' => 1];
       }
     return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function getDataById($data)
    {
      $statement = $this->db->pdo->prepare("SELECT * FROM tbl_penjualan WHERE id_user = :userid and time(tanggal) = :tanggal");
      $statement->execute([
        'userid' => $this->id,
        'tanggal' => $this->tanggal
      ]);
      return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function storeData()
    {
      $statement = $this->db->pdo->prepare("INSERT INTO tbl_detail_penjualan (id_penjualan, id_barang, jumlah, total) VALUES(:penjualanId, :barangId, :jumlah, :total) ");
      foreach ($this->barang as $value) {
        $statement->execute([
          'penjualanId' => $this->id,
          'barangId' => $value['namabarang'],
          'jumlah' => $value['jumlah'],
          'total' => floatval(str_replace(',', '.', str_replace('.', ' ', $value['harga']))) * floatval(str_replace(',', '.', str_replace('.', ' ', $value['jumlah']))),
        ]);
      };
    }
    public function storeDataAndMove()
    {
      $statement = $this->db->pdo->prepare("INSERT INTO tbl_penjualan (id_user, tanggal) VALUES(:user, :tanggal)");
      $statement->execute([
        'user' => $this->id,
        'tanggal' => $this->tanggal
      ]);
    }
    public function updateData($id)
    {

    }
    public function deleteData($id)
    {

    }
  }
  
