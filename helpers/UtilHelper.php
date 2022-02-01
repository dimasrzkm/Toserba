<?php
  namespace app\helpers;
  use app\Database;
  use PDO;
  class UtilHelper 
  {
    public static function selectTable($table)
    {
      $data = new Database();
      $statement = $data->pdo->query("SELECT * FROM $table");
      $statement->execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    // pembuatan random String
    public static function randomString($n)
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $str = '';
      for ($i=0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
      }
      return $str;
    }
    public static function hidePassword($data)
    {
      $str = '';
      for ($i=0; $i <= 5; $i++) { 
        $str .= '*';
      }
      return $str;
    }
  }