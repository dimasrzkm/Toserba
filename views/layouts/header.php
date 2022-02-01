<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Toserba</title>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="/utility.css">
</head>
<body>
  <div class="navbar-fixed">
    <nav>
      <div class="nav-wrapper blue darken-3">
        <a href="/" class="brand-logo">Warung Zainidar</a>
        <a href="#" data-target="mobile-responsive" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <?php if ($_SESSION['level'] === 'Admin') : ?>
            <li><?= $_SESSION['username']; ?></li>
            <li><a href="/transaksi">Transaksi</a></li>
            <li><a href="/user">User</a></li>
            <li><a href="/barang">Barang</a></li>
            <li><a href="/kategori">Kategori</a></li>
            <li><a href="/logout">Keluar</a></li>
            <?php else: ?>
              <li><?= $_SESSION['username']; ?></li>
              <li><a href="/transaksi">Transaksi</a></li>
              <li><a href="/barang">Barang</a></li>
              <li><a href="/kategori">Kategori</a></li>
              <li><a href="/logout">Keluar</a></li>
          <?php endif; ?>
          </ul>
        </div>
      </nav>
    </div>
    <ul class="sidenav" id="mobile-responsive">
      <?php if ($_SESSION['level'] === 'Admin') : ?>
        <li><?= $_SESSION['username']; ?></li>
        <li><a href="/transaksi">Transaksi</a></li>
        <li><a href="/user">User</a></li>
        <li><a href="/barang">Barang</a></li>
        <li><a href="/kategori">Kategori</a></li>
        <li><a href="/logout">Keluar</a></li>
      <?php else: ?>
        <li><?= $_SESSION['username']; ?></li>
        <li><a href="/transaksi">Transaksi</a></li>
        <li><a href="/barang">Barang</a></li>
        <li><a href="/kategori">Kategori</a></li>
        <li><a href="/logout">Keluar</a></li>
      <?php endif; ?>
    </ul>
  <main class="container">
    <?php 
      // menampilkan data hasil dari buffer pada Router
      echo $content;
    ?>
  </main>       
        
  