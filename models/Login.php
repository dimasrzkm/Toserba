<?php
  namespace app\models;
  use app\Database;
  use Exception;
  use PDO;
  use PDOException;

  class Login 
  {
    public $db = null;
    protected $username = null;
    protected $password = null;
    public function __construct()
    {
      $this->db = new Database();
    }
    public function load($data)
    {
      if (!$data['username'] && !$data['password']) {
        return [
          'Username Tidak boleh kosong',
          'Password Tidak boleh kosong'
        ];
      } else if (!$data['username']) 
      {
        return  ['Username tidak boleh kosong'];
      } else if (!$data['password'])
      {
        return ['Password tidak boleh kosong'];
      } else 
      {
        $this->username = $this->filterAndSanitizeUsername($data['username']);
        $this->password = $this->filterAndSanitizeUsername($data['password']);
      }
    }
    public function login()
    {
      $checkUsername = $this->db->pdo->prepare("SELECT * FROM tbl_user WHERE username = :username");
      try {
        $checkUsername->execute(['username' => $this->username]);
      } catch (PDOException $e) {
        throw new Exception("Query is invalid");
      }
      $user = $checkUsername->fetch(PDO::FETCH_ASSOC);
      if (is_array($user)) {
        if ($this->password === $user['password']) {
          $_SESSION['id_user'] = $user['id_user'];
          $_SESSION['username'] = $user['nama_user'];
          $_SESSION['level'] = $user['level'];
          header('Location: /barang');
        }
      }
      return ['Username Atau password salah'];
    }
    public function filterAndSanitizeUsername($data)
    {
      $filterUsername = filter_var($data, FILTER_SANITIZE_STRING);
      return trim($filterUsername);
    }
  }