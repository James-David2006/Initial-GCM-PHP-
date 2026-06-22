<?php
include '../config.php';

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=donations.csv");

$output = fopen("php://output", "w");
fputcsv($output, ['Name', 'Email', 'Amount', 'Date']);

$result = $conn->query("SELECT name, email, amount, created_at FROM donations ORDER BY id DESC");
while ($row = $result->fetch_assoc()) {
  fputcsv($output, $row);
}
fclose($output);
exit();
