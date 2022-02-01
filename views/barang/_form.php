<?php use app\helpers\UtilHelper; ?>
<div class="row">
  <form action="" method="POST" class="col s12" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=  $dataBarang['id_barang']; ?>">
    <div class="row">
      <div class="input-field col s12">
        <input type="text" id="nama" name="namabarang" value="<?php echo $dataBarang['nama_barang'];?>" />
        <label for="nama">Nama Barang</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input type="number" step=".01"  name="hargabarang" id="hrga" value="<?php echo $dataBarang['harga_barang'];?>" />
        <label for="hrga">Harga</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input type="number" value="<?php echo $dataBarang['stok'];?>" disabled/>
        <label>Stok</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <select name="satuanbarang">
          <option value="" disabled selected>Pilih Satuan</option>
            <option value="kg" <?php echo ($dataBarang['satuan'] == 'kg') ? 'selected' : '' ?> >Kilogram</option>
            <option value="renteng" <?php echo ($dataBarang['satuan'] == 'renteng') ? 'selected' : '' ?>>Renteng</option>
            <option value="sak" <?php echo ($dataBarang['satuan'] == 'sak') ? 'selected' : '' ?>>Sak</option>
            <option value="liter" <?php echo ($dataBarang['satuan'] == 'liter') ? 'selected' : '' ?>>Liter</option>
            <option value="sachet" <?php echo ($dataBarang['satuan'] == 'sachet') ? 'selected' : '' ?>>Sachet</option>
            <option value="dus" <?php echo ($dataBarang['satuan'] == 'dus') ? 'selected' : '' ?>>Dus</option>
        </select>
        <label>Satuan</label>
      </div>
    </div>
    <div class="row">
      <div class="file-field input-field">
        <div class="btn">
          <span>File</span>
          <input type="file" name="gambarbarang">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text" placeholder="Upload Gambar" >
        </div>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <select name="idkategori">
          <option value="" disabled selected>Pilih Kategori</option>
          <?php $dataKategori = UtilHelper::selectTable('tbl_kategori'); ?>
          <?php foreach ($dataKategori as $kategori) : ?>
            <option value="<?= $kategori['id_kategori']; ?>" <?=  ($kategori['id_kategori'] == $dataBarang['id_kategori']) ? 'selected' : '' ?> ><?= $kategori['nama_kategori']; ?></option> 
          <?php endforeach; ?>
        </select>
        <label>Kategori</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6 offset-s6">
        <input 
          type="submit" 
          class="btn btn-small col s6 offset-s6" 
          value="<?php echo ($_SERVER['PATH_INFO'] === '/barang/create') ? 'Tambah' : 'Ubah' ?>" />
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