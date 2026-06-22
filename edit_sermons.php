<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../config.php';

if (isset($_POST['add_sermon'])) {
  $title = $_POST['title'];
  $minister = $_POST['minister'];
  $date = $_POST['date'];
  $link = $_POST['video_link'];
  $stmt = $conn->prepare("INSERT INTO sermons (title, minister, date, video_link) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $title, $minister, $date, $link);
  $stmt->execute();
}
$sermons = $conn->query("SELECT * FROM sermons ORDER BY date DESC");
?>

<!DOCTYPE html>
<html><head><title>Sermons</title><style>
form, input, textarea, button { width:100%; margin-bottom:1rem; padding:10px; border-radius:6px; }
button {background: blue;color: white}
iframe { width:100%; height:300px; }
</style></head>
<body>
<h2>Add Sermon</h2>
<form method="post">
  <input name="title" placeholder="Sermon Title" required>
  <input name="minister" placeholder="Minister Name" required>
  <input type="date" name="date" required>
  <input name="video_link" placeholder="YouTube Embed Link" required>
  <button name="add_sermon">Add Sermon</button>
</form>
<h3>All Sermons</h3>
<?php while ($s = $sermons->fetch_assoc()): ?>
  <div><b><?= $s['title'] ?> - <?= $s['minister'] ?></b> (<?= $s['date'] ?>)<br>
  <iframe src="<?= $s['video_link'] ?>" frameborder="0" allowfullscreen></iframe></div>
<?php endwhile; ?>
<a href="dashboard.php">← Back</a>
</body></html>
