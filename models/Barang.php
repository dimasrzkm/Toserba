<?php
  // membuat namespace untuk barang
  namespace app\models;
  // menggunakan Class abstract Model untuk di inheritance
  use app\src\abstracts\Model;
  // menggunakan Class Database
  use app\Database;
  // menggunakan Class Helper
  use app\helpers\UtilHelper;
  // menggunakan PDO Extension 
  use PDO;
  use PDOException;

class Barang extends Model
  {
    // mendefenisikan property dari Class Barang
    public $db;
    public ?int $idBarang = null;
    public ?string $namaBarang = null;
    public ?float $hargaBarang = null;
    public ?int $stokBarang = null;
    public ?string $satuanBarang = null;
    public ?array $gambarBarang = null;
    public ?string $gambarLokasi = null;
    public ?int $idKategori = null;

    public function __construct()
    {
      // menginialisasi object property db dengan Class Database
      $this->db = new Database();
    }
    // method yang diinheritance dari Class Model
    public function load($data)
    {
      $this->idBarang = (int) $data['id_barang'] ?? null;
      $this->namaBarang = $data['nama_barang'] ?? '';
      $this->hargaBarang = $data['harga_barang'] ?? 0.0;
      $this->satuanBarang = $data['satuan'] ?? '';
      $this->gambarBarang = $data['gambarFile'] ?? null;
      $this->gambarLokasi = $data['gambar'] ?? null;
      $this->idKategori = $data['id_kategori'] ?? null;
    }
    // method yang diinheritance dari Class Model
    public function save()
    {
      $errors = [];
      if (!$this->namaBarang) {
        array_push($errors,'Nama barang tidak boleh kosong');
      }
      if (!$this->hargaBarang) {
        array_push($errors,'Harga barang tidak boleh kosong');
      }
      if (!$this->satuanBarang) {
        array_push($errors,'Satuan barang tidak boleh kosong');
      }
      if (!is_dir(__DIR__.'./../public/images')) {
        mkdir(__DIR__.'./../public/images');
      }
      // jika image di upload dan teradapat nama sementara
      if ($this->gambarBarang && $this->gambarBarang['tmp_name']) {
        if ($this->gambarLokasi) {
          // penghapusan image yang lama          
          unlink(__DIR__.'/../public/'.$this->gambarLokasi);
          // memisahkan path menjadi array
          $arrayFileGambar = explode('/', $this->gambarLokasi);
          // menghapus index terakhir
          $fileGambar = array_pop($arrayFileGambar);
          // menyambung kembali array menjadi path folder dimana gambar berada
          $fileGambar = implode('/', $arrayFileGambar);
          // menghapus folder
          rmdir('./'.$fileGambar);
        }
        if ($this->gambarBarang['size'] > 1000 * 1000) {
          array_push($errors, "Ukuran array tidak boleh lebih dari 1Mb");
        }
        $ekstensiDibolehkan = [
          'image/png',
          'image/jpg',
          'image/jpeg',
          'image/webp'
        ];
        if (!in_array(mime_content_type($this->gambarBarang['tmp_name']), $ekstensiDibolehkan)) {
          array_push($errors, "Tipe file tidak diijinkan.");
        }
        $this->gambarLokasi = 'images/'.UtilHelper::randomString(8).'/'.$this->gambarBarang['name'];
        mkdir(dirname(__DIR__.'/../public/'.$this->gambarLokasi));
        move_uploaded_file($this->gambarBarang['tmp_name'], __DIR__.'/../public/'.$this->gambarLokasi);
      }
      if (empty($errors)) {
        if ($this->idBarang) {
          $this->updateData($this->idBarang);
        } else {
          $this->storeData();
        }
      }
      return $errors;
    }
    // method yang diinheritance dari Class Model
    public function getAllData()
    {
      $statement = $this->db->pdo->query("SELECT * FROM view_barang");
      $statement->execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    // method yang diinheritance dari Class Model
    public function getDataById($data)
    {
      $statement = $this->db->pdo->prepare("SELECT * FROM tbl_barang WHERE id_barang = :id");
      $statement->execute([
        'id' => $data
      ]);
      return $statement->fetch(PDO::FETCH_ASSOC);
    }
    // method yang diinheritance dari Class Model
    public function storeData()
    {
      $statement = $this->db->pdo->prepare("INSERT INTO tbl_barang (nama_barang, harga_barang, gambar, stok, satuan, id_kategori, created_at) VALUES(:nama, :harga, :gambar, :stok, :satuan, :kategori, :date) ");
      $statement->execute([
        'nama' => $this->namaBarang,
        'harga' => $this->hargaBarang,
        'gambar' => $this->gambarLokasi,
        'stok' => 0,
        'satuan' => $this->satuanBarang,
        'kategori' => $this->idKategori,
        'date' => date('Y-m-d H:i:s')
      ]);
    }
    // method yang diinheritance dari Class Model
    public function updateData($id)
    {
      $statement = $this->db->pdo->prepare("UPDATE tbl_barang SET nama_barang = :nama, harga_barang = :harga, satuan = :satuan, gambar = :gambar, id_kategori = :kategori, updated_at = :update WHERE id_barang = :id");
      $statement->execute([
        'nama' => $this->namaBarang,
        'harga' => $this->hargaBarang,
        'gambar' => $this->gambarLokasi,
        'kategori' => $this->idKategori,
        'satuan' => $this->satuanBarang,
        'update' => date('Y-m-d H:i:s'),
        'id' => $this->idBarang
      ]);
    }
    // method yang diinheritance dari Class Model
    public function deleteData($id)
    {
      $data = $this->getDataById($id);
      // jika data gambar tidak kosong maka jalankan perintahnya
      if (!empty($data['gambar'])) {
        // menghapus gambar dari folder
        unlink('./'.$data['gambar']);
        // memisahkan path menjadi array
        $arrayFileGambar = explode('/', $data['gambar']);
        // menghapus index terakhir
        $fileGambar = array_pop($arrayFileGambar);
        // menyambung kembali array menjadi path folder dimana gambar berada
        $fileGambar = implode('/', $arrayFileGambar);
        // menghapus folder
        rmdir('./'.$fileGambar);
        // mendelete data
      }
      $statement = $this->db->pdo->prepare("DELETE FROM tbl_barang WHERE id_barang = :id");
      try {
        $statement->execute([
          'id' => $id
        ]);
      } catch (Exception $e) {
        // throw new PDOException("Query is invalid");
        echo $e->getMessage();
      }
    }
  }