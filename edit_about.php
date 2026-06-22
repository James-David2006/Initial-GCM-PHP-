<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $intro = $_POST['intro'];
  $mission = $_POST['mission'];
  $vision = $_POST['vision'];
  $values = $_POST['values'];

  $stmt = $conn->prepare("UPDATE about SET intro=?, mission=?, vision=?, values=? WHERE id=1");
  $stmt->bind_param("ssss", $intro, $mission, $vision, $values);
  $stmt->execute();
}
$data = $conn->query("SELECT * FROM about WHERE id=1")->fetch_assoc();
?>

<!DOCTYPE html>
<html><head><title>Edit About</title><link rel="stylesheet" href="../style.css"><style>
form, textarea, input, button { width:100%; margin-bottom:1rem; padding:10px; border-radius:6px; }
body { background:#f5f9ff; font-family:sans-serif; padding:2rem; }
button { background:#007bff; color:#fff; border:none; }
</style></head>
<body>
  <h2>Edit About Section</h2>
  <form method="post">
    <label>Intro:</label><textarea name="intro"><?= $data['intro'] ?></textarea>
    <label>Mission:</label><textarea name="mission"><?= $data['mission'] ?></textarea>
    <label>Vision:</label><textarea name="vision"><?= $data['vision'] ?></textarea>
    <label>Core Values:</label><textarea name="values"><?= $data['values'] ?></textarea>
    <button type="submit">Save</button>
  </form>
  <a href="dashboard.php">← Back</a>
</body></html>
