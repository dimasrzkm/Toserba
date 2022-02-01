<?php
  use app\helpers\UtilHelper;
?>
<h3>Beli barang</h3>
<div class="row form">
  <form class="col s12 form-penjualan-barang" action="" method="post">
    <div class="row">
      <div class="input-field col s12">
        <input disabled id="disableId" name="idpembelian" type="text" class="validate" value="<?= ($dataPembelian['id_pembelian'] === 1) ? $dataPembelian['id_pembelian'] : $dataPembelian['id_pembelian'] + 1; ?>">
        <label for="disableId">ID Beli</label>
      </div>
    </div>
    <?php for ($i= 1; $i < 6; $i++) : ?> 
      <?php if ($i === 1) :?>
        <div class="wrapper-tambahan-<?= $i; ?>">
      <?php else: ?>
        <div class="wrapper-tambahan-<?= $i; ?> hidden">
      <?php endif; ?>
        <div class="row select-barang">
          <div class="input-field col s12">
            <select name="barang[<?= $i; ?>][namabarang]" id="barangs" class="test<?= $i; ?>">
              <option value="" disabled selected>Pilih Barang</option>
              <?php $dataBarang = UtilHelper::selectTable("tbl_barang"); ?>
              <?php foreach ($dataBarang as $barang) : ?>
                <option value="<?= $barang['id_barang']; ?>"><?= $barang['nama_barang']; ?></option>
                <?php
                  $harga = $barang['harga_barang'];
                ?>
              <?php endforeach; ?>
            </select>
            <label for="barang">Barang</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="disableIdHarga<?= $i; ?>" name="barang[<?= $i; ?>][harga]" type="text" class="validate harga<?= $i; ?>" value="" readonly>
            <label for="disableIdHarga<?= $i; ?>" class="label-harga-<?= $i; ?>">Harga</label>
          </div>
        </div>
        <div class="row jumlah-beli">
          <div class="input-field col s12">
            <input id="jumlah-<?= $i; ?>" type="number" step="1" class="validate" name="barang[<?= $i; ?>][jumlah]" >
            <label for="jumlah-<?= $i; ?>">Jumlah Beli</label>
          </div>
        </div>
      </div>
    <?php endfor; ?>
    <div class="floating-wrapper">
        <a class="trigger-tambah btn-floating btn-large waves-effect waves-light  blue darken-2"><i class="material-icons">add</i></a>
    </div>
    <button class="btn light-blue darken-1 waves-effect waves-light" type="submit">Beli
       <i class="material-icons right">send</i>
    </button>
  </form>
</div>
<?php  include_once __DIR__.'/../layouts/footer.php'; ?>
<script src="/script.js"></script>