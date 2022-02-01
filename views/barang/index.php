<?php
  if (!$_SESSION['username'])
  {
    header('Location: /login');
  }
  $dataBarangKosong[] = null;
?>
<h2>Barang</h2>
<div class="row">
  <a href="/barang/create" class="col xl4 l4 m5 s12  btn light-blue darken-1 waves-effect waves-light">Tambah Data</a>
</div>
<table class="responsive-table my-1">
  <thead>
    <th>#</th>
    <th class="center-align">Gambar</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Kategori</th>
    <th>Aksi</th>
  </thead>
  <tbody>
    <?php foreach ($dataBarang as $i => $barang) : ?>
      <?php
        if ($barang['stok'] <= 5) {
          array_push($dataBarangKosong, "stok {$barang['nama_barang']} segera habis");
        }
      ?>
      <tr>
        <td><?php echo ++$i; ?></td>
        <td class="center-align">
          <?php if($barang['gambar']) : ?>
            <img src="./<?php echo $barang['gambar']  ?>" alt="<?= $barang['nama_barang']; ?>" class="image-avatar" loading="lazy">
          <?php endif; ?>
        </td>
        <td><?php echo $barang['nama_barang']; ?></td>
        <td><?php echo "Rp.{$barang['harga_barang']} " ?></td>
        <td><?php echo "{$barang['stok']} {$barang['satuan']}" ?></td>
        <td><?php echo $barang['nama_kategori']; ?></td>
        <td>
          <a href="/barang/update?id=<?php echo $barang['id_barang']; ?>" class="btn btn-small  amber darken-3 waves-effect waves-light">Edit</a>
          <form action="/barang/delete" method="POST" class="dinline">
            <input type="hidden" name="id" value="<?php echo $barang['id_barang']; ?>">
            <input type="submit" class="btn btn-small red darken-1 input-submit" value="Delete">
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php  include_once __DIR__.'/../layouts/footer.php'; ?>
<script>
  <?php if (!empty($dataBarangKosong)) : ?>
    <?php foreach ($dataBarangKosong as $barangKosong) : ?>
      <?php if (!is_null($barangKosong)) : ?>
        M.toast({
            html: '<?php echo $barangKosong; ?>',
            classes: 'rounded',
            outDuration: 2000
          }
        );
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif; ?>
</script>