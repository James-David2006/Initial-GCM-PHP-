<?php
include '../config.php';
$result = $conn->query("SELECT * FROM donations ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Donations | GCM</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">
  <div class="container">
    <h3 class="mb-4 text-success">💰 Donations</h3>
    <table class="table table-bordered bg-white shadow-sm">
      <thead class="table-success">
        <tr>
          <th>Name</th><th>Email</th><th>Amount</th><th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>₦<?= number_format($row['amount'], 2) ?></td>
            <td><?= $row['created_at'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
