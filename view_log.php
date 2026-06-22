<?php
include '../config.php';
$result = $conn->query("SELECT * FROM audit_log ORDER BY id DESC");
?>
<h2>Audit Log</h2>
<table>
<tr><th>Admin</th><th>Action</th><th>Time</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
  <td><?= $row['admin'] ?></td>
  <td><?= $row['action'] ?></td>
  <td><?= $row['timestamp'] ?></td>
</tr>
<?php endwhile; ?>
</table>
