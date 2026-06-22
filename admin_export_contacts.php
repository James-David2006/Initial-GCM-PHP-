<?php
include '../config.php';

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=contacts.csv");

$output = fopen("php://output", "w");
fputcsv($output, ['Name', 'Email', 'Message', 'Date']);

$result = $conn->query("SELECT name, email, message, created_at FROM contacts ORDER BY id DESC");
while ($row = $result->fetch_assoc()) {
  fputcsv($output, $row);
}
fclose($output);
exit();
