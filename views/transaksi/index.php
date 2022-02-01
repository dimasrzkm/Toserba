<h4>Transaksi Penjualan</h4>
<table class="responsive-table my-1">
  <thead>
    <th>#</th>
    <th>ID Penjualan</th>
    <th>Nama Pegawai</th>
    <th>Barang</th>
    <th>Jumlah</th>
    <th>Total</th>
    <th>Tanggal</th>
    <th>Waktu</th>
  </thead>
  <tbody>
    <?php foreach ($dataPenjualan as $i => $penjualan) : ?>
      <tr>
        <td><?php echo ++$i; ?></td>
        <td><?php echo $penjualan['id_penjualan']; ?></td>
        <td><?php echo $penjualan['nama_user']; ?></td>
        <td><?php echo $penjualan['nama_barang']; ?></td>
        <td><?php echo $penjualan['jumlah']; ?></td>
        <td><?php echo $penjualan['total']; ?></td>
        <td><?php echo date_format(new DateTime($penjualan['tanggal']),  'd-m-Y'); ?></td>
        <td><?php echo date_format(new DateTime($penjualan['tanggal']),  'H:i:s'); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<h4>Transaksi Pembelian</h4>
<table class="responsive-table my-1">
  <thead>
    <th>#</th>
    <th>ID Pembelian</th>
    <th>Nama Pegawai</th>
    <th>Barang</th>
    <th>Jumlah</th>
    <th>Total</th>
    <th>Tanggal</th>
    <th>Waktu</th>
  </thead>
  <tbody>
  <?php foreach ($dataPembelian as $i => $pembelian) : ?>
      <tr>
        <td><?php echo ++$i; ?></td>
        <td><?php echo $pembelian['id_pembelian']; ?></td>
        <td><?php echo $pembelian['nama_user']; ?></td>
        <td><?php echo $pembelian['nama_barang']; ?></td>
        <td><?php echo $pembelian['jumlah']; ?></td>
        <td><?php echo $pembelian['total']; ?></td>
        <td><?php echo date_format(new DateTime($pembelian['tanggal']),  'd-m-Y'); ?></td>
        <td><?php echo date_format(new DateTime($pembelian['tanggal']),  'H:i:s'); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div class="row">
  <div class="col s6 offset-s6">
    <div class="row">
      <a href="/pembelian/create" class="col s6 btn light-blue darken-1 waves-effect waves-light">Beli Barang</a>
      <a href="/penjualan/create" class="col s6 btn light-blue darken-1 waves-effect waves-light">Jual Barang</a>
    </div>
  </div>
</div>
<?php  include_once __DIR__.'/../layouts/footer.php'; ?>