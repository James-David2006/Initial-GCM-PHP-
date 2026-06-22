<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}
include '../config.php';

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $current = $_POST['current'];
  $new = $_POST['new'];
  $confirm = $_POST['confirm'];
  $user = $_SESSION['admin'];

  $result = $conn->query("SELECT * FROM admins WHERE username = '$user'");
  $row = $result->fetch_assoc();

  if (!password_verify($current, $row['password'])) {
    $msg = "❌ Current password is incorrect.";
  } elseif ($new !== $confirm) {
    $msg = "❌ New passwords do not match.";
  } else {
    $hashed = password_hash($new, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE admins SET password=? WHERE username=?");
    $stmt->bind_param("ss", $hashed, $user);
    $stmt->execute();
    $msg = "✅ Password changed successfully!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Change Password</title>
  <style>
    body { font-family: sans-serif; padding: 2rem; background: #f8f9fc; }
    form { background: white; padding: 20px; border-radius: 10px; width: 400px; max-width: 90%; }
    input, button { width: 100%; padding: 10px; margin-bottom: 1rem; border-radius: 6px; border: 1px solid #ccc; }
    button { background: #007BFF; color: white; border: none; }
  </style>
</head>
<body>
  <h2>🔐 Change Password</h2>
  <form method="post">
    <input type="password" name="current" placeholder="Current Password" required>
    <input type="password" name="new" placeholder="New Password" required>
    <input type="password" name="confirm" placeholder="Confirm New Password" required>
    <button type="submit">Update Password</button>
    <p><?= $msg ?></p>
  </form>
  <a href="dashboard.php">← Back to Dashboard</a>
</body>
</html>
