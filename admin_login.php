<?php
session_start();
include '../config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = $conn->query("SELECT * FROM admins WHERE username='$username'");
  $admin = $query->fetch_assoc();
  if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['admin'] = $username;
    header("Location: dashboard.php");
  } else {
    $error = "Invalid login credentials.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login | GCM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f0f4ff;
      font-family: 'Segoe UI';
    }
    .login-box {
      max-width: 400px;
      margin: 80px auto;
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .move {
        background: white; padding: 20px; border-radius: 10px; width: 400px; max-width: 90%;
      }
      input, button { width: 100%; padding: 10px; margin-bottom: 1rem; border-radius: 6px; border: 1px solid #ccc; }
    button { background: #007BFF; color: white; border: none; }
  </style>
</head>
<body>
  <div class="login-box">
    <h3 class="text-center text-primary">GCM Admin Login</h3>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
      <div class="move">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required />
      </div>
      <div class="move">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required />
      </div>
      <button class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</body>
</html>
