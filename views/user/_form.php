<div class="row">
  <form action="" method="POST" class="col s12">
    <div class="row">
      <div class="input-field col s12">
        <input type="text" id="nama" name="namalengkap" value="<?php echo $usersData['nama_user'];?>" />
        <label for="nama">Nama Lengkap</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input type="text" name="username" id="usrname" value="<?php echo $usersData['username'];?>" />
        <label for="usrname">Username</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input type="password" name="password" id="passwd" value="<?php echo $usersData['password']; ?>" />
        <label for="passwd">Password</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <select name="leveluser">
          <option value="" disabled selected>Pilih level akses</option>
          <option value="Admin" <?php echo ($usersData['level'] == 'Admin') ? 'selected' : '' ?> >Admin</option>
          <option value="Pegawai" <?php echo ($usersData['level'] == 'Pegawai') ? 'selected' : '' ?> >Pegawai</option>
        </select>
        <label>Akses</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6 offset-s6">
        <input 
          type="submit" 
          class="btn btn-small col s6 offset-s6" 
          value="<?php echo ($_SERVER['PATH_INFO'] === '/user/create') ? 'Tambah' : 'Ubah' ?>" />
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
