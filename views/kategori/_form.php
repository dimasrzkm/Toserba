<div class="row">
  <form action="" method="POST" class="col s12">
    <div class="row">
      <div class="input-field col s12">
        <input id="kategori" type="text" name="namaKategori" value="<?php echo $kategoriesData['nama_kategori']; ?>">
        <label for="kategori" class="<?php ($kategoriesData['nama_kategori']) ? 'active' : '' ?>">Kategori</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6 offset-s6">
        <input 
          type="submit" 
          class="btn btn-small col s6 offset-s6" 
          value="<?php echo ($_SERVER['PATH_INFO'] === '/kategori/create') ? 'Tambah' : 'Ubah' ?>" />
      </div>
    </div>
  </form>
</div>

<?php  include_once __DIR__.'/../layouts/footer.php'; ?>

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