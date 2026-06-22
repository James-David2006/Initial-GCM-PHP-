<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
include '../config.php';

if (isset($_POST['add_pastor'])) {
  $name = $_POST['name'];
  $title = $_POST['title'];
  $bio = $_POST['bio'];
  $img = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];
  move_uploaded_file($tmp, "../uploads/$img");
  $stmt = $conn->prepare("INSERT INTO pastors (name, title, bio, image) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $title, $bio, $img);
  $stmt->execute();
}
$pastors = $conn->query("SELECT * FROM pastors ORDER BY id DESC");
?>

<!DOCTYPE html>
<html><head><title>Manage Pastors</title><style>
form, input, textarea, button { width:100%; margin-bottom:1rem; padding:10px; border-radius:6px;}
button {background: blue;color: white}
img { width:150px; border-radius:8px; }
</style></head>
<body>
<h2>Pastors</h2>
<form method="post" enctype="multipart/form-data">
  <input name="name" placeholder="Full Name" required>
  <input name="title" placeholder="Position/Post" required>
  <textarea name="bio" placeholder="Short Bio"></textarea>
  <input type="file" name="image" accept="image/*" required>
  <button name="add_pastor">Add Pastor</button>
</form>
<h3>All Pastors</h3>
<?php while ($p = $pastors->fetch_assoc()): ?>
  <div><img src="../uploads/<?= $p['image'] ?>"><br><b><?= $p['name'] ?> (<?= $p['title'] ?>)</b></div>
<?php endwhile; ?>
<a href="dashboard.php">← Back</a>
</body></html>
