<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../config.php';

if (isset($_POST['add_event'])) {
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $date = $_POST['date'];
  $img = $_FILES['banner']['name'];
  $tmp = $_FILES['banner']['tmp_name'];
  move_uploaded_file($tmp, "../uploads/$img");
  $stmt = $conn->prepare("INSERT INTO events (title, description, date, banner) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $title, $desc, $date, $img);
  $stmt->execute();
}
$events = $conn->query("SELECT * FROM events ORDER BY date DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Events</title>
<link rel="stylesheet" href="../style.css">
<style>
form, input, textarea, button { width:100%; margin-bottom:1rem; padding:10px; border-radius:6px;}
button{background: blue; color: white}
img { width: 200px; margin: 10px 0; }
</style></head>
<body>
<h2>Upcoming Events</h2>
<form method="post" enctype="multipart/form-data">
  <input name="title" placeholder="Event Title" required>
  <textarea name="description" placeholder="Description" required></textarea>
  <input type="date" name="date" required>
  <input type="file" name="banner" accept="image/*" required>
  <button name="add_event">Add Event</button>
</form>
<h3>All Events</h3>
<?php while ($e = $events->fetch_assoc()): ?>
  <div><b><?= $e['title'] ?></b> - <?= $e['date'] ?><br><img src="../uploads/<?= $e['banner'] ?>" alt=""></div>
<?php endwhile; ?>
<a href="dashboard.php">← Back</a>
</body></html>
