<?php

use app\helpers\UtilHelper;

if (!$_SESSION['username'])
  {
    header('Location: /login');
  }
?>
<h2>Users</h2>
<a href="/user/create" class="btn light-blue darken-1 waves-effect waves-light">Tambah Data</a>
<table class="responsive-table my-1">
  <thead>
    <th>#</th>
    <th>Nama</th>
    <th>username</th>
    <th>password</th>
    <th>level akses</th>
    <th>Aksi</th>
  </thead>
  <tbody>
    <?php foreach ($dataUsers as $i => $user) : ?>
      <tr>
        <td><?php echo ++$i; ?></td>
        <td><?php echo $user['nama_user']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo UtilHelper::hidePassword($user['password']); ?></td>
        <td><?php echo $user['level']; ?></td>
        <td>
          <a href="/user/update?id=<?php echo $user['id_user']; ?>" class="btn btn-small  amber darken-3 waves-effect waves-light">Edit</a>
          <form action="/user/delete" method="POST" class="dinline">
            <input type="hidden" name="id" value="<?php echo $user['id_user']; ?>">
            <input type="submit" class="btn btn-small red darken-1 input-submit" value="Delete">
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php  include_once __DIR__.'/../layouts/footer.php'; ?>
