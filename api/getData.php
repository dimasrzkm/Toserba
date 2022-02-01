<?php
  namespace app\api;
  use app\models\Barang;

class getData  
  {
    protected $Barang;
    public function __construct()
    {
      $this->Barang = new Barang();
    }
    public function index()
    {
      // $data = [
      //   [
      //     "id_barang" => 1,
      //     "nama_barang" => "Beras",
      //     "harga_barang" => "12.000,00",
      //     "gambar" => null,
      //     "stok" => 0,
      //     "satuan" => "kg",
      //     "id_kategori" => 1,
      //     "created_at" => "2021-12-08 13:47:03",
      //     "updated_at" => null
      //   ],
      //   [
      //     "id_barang" => 2,
      //     "title" => "Gula Putih",
      //     "harga_barang" => "5.000,00",
      //     "gambar" => null,
      //     "stok" => 0,
      //     "satuan" => "kg",
      //     "id_kategori" => 1,
      //     "created_at" => "2021-12-08 13:52:01",
      //     "updated_at" => "2022-01-04 13:38:52"
      //   ]
      // ];
      $data = $this->Barang->getAllData();
      $dataJSON = json_encode($data);
      echo $dataJSON;
    }
  }