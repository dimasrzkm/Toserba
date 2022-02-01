<?php
  if (!$_SESSION['username'])
  {
    header('Location: /login');
  }
?>
<h2>Kategori</h2>
<a href="/kategori/create" class="btn light-blue darken-1 waves-effect waves-light">Tambah Data</a>
<table class="responsive-table my-1">
  <thead>
    <th>#</th>
    <th>Nama Kategori</th>
    <th>Aksi</th>
  </thead>
  <tbody>
    <?php foreach ($kategories as $i => $kategori) : ?>
      <tr>
        <td><?php echo ++$i; ?></td>
        <td><?php echo $kategori['nama_kategori']; ?></td>
        <td>
          <a href="/kategori/update?id=<?php echo $kategori['id_kategori']; ?>" class="btn btn-small  amber darken-3 waves-effect waves-light">Edit</a>
          <form action="/kategori/delete" method="POST" class="dinline">
            <input type="hidden" name="id" value="<?php echo $kategori['id_kategori']; ?>">
            <input type="submit" class="btn btn-small red darken-1 input-submit" value="Delete">
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php  include_once __DIR__.'/../layouts/footer.php'; ?>