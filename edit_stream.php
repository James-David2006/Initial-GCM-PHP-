<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $link = $_POST['video_embed'];
  $stmt = $conn->prepare("UPDATE stream SET video_embed=? WHERE id=1");
  $stmt->bind_param("s", $link);
  $stmt->execute();
}
$data = $conn->query("SELECT * FROM stream WHERE id=1")->fetch_assoc();
?>

<!DOCTYPE html>
<html><head><title>Edit Livestream</title><style>
textarea, input, button { width:100%; margin-bottom:1rem; padding:10px; }
button {background: blue;color: white;}
</style></head><body>
<h2>Update Livestream Embed</h2>
<form method="post">
  <textarea name="video_embed" rows="4"><?= $data['video_embed'] ?></textarea>
  <button>Save Stream</button>
</form>
<a href="dashboard.php">← Back</a>
</body></html>
