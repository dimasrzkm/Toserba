<?php
  if (@$_SESSION['username'])
  {
    header('Location: /barang');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Toserba</title>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="/utility.css">
</head>
<body>
  <main class="container">
    <?php 
      // menampilkan data hasil dari buffer pada Router
      echo $content;
    ?>
  </main>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <?php  if (!empty($errors)) : ?>
  <script>
    <?php foreach ($errors as $error) : ?>
      M.toast({
          html: '<?php echo $error; ?>',
          classes: 'rounded',
          outDuration: 800
        }
      );
    <?php endforeach; ?>
  </script>
<?php endif; ?>
</body>
</html>
        
  