<?php
  namespace app\src\abstracts;
  use app\src\interfaces\User;

  abstract class Model implements User
  {
    abstract public function save();
    abstract public function load($data);
    abstract public function getAllData();
    abstract public function getDataById($data);
    abstract public function storeData();
    abstract public function updateData($id);
    abstract public function deleteData($id);
  }