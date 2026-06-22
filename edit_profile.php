<?php
session_start();
if (!isset($_SESSION['admin'])) exit();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['full_name'];
  $user = $_SESSION['admin'];
  
  $photo = $_FILES['photo']['name'];
  $tmp = $_FILES['photo']['tmp_name'];
  
  if ($photo) {
    move_uploaded_file($tmp, "../uploads/$photo");
    $conn->query("UPDATE admins SET full_name='$name', photo='$photo' WHERE username='$user'");
  } else {
    $conn->query("UPDATE admins SET full_name='$name' WHERE username='$user'");
  }
}

$data = $conn->query("SELECT * FROM admins WHERE username='{$_SESSION['admin']}'")->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
  <input name="full_name" value="<?= $data['full_name'] ?>" placeholder="Full Name">
  <input type="file" name="photo">
  <button>Update Profile</button>
</form>
