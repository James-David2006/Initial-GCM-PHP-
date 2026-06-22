<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = htmlspecialchars($_POST['name']);
  $email = $_POST['email'];
  $amount = floatval($_POST['amount']);

  $stmt = $conn->prepare("INSERT INTO donations (name, email, amount) VALUES (?, ?, ?)");
  $stmt->bind_param("ssd", $name, $email, $amount);
  $stmt->execute();

  // Email notification
  send_email("godscaremissions@yahoo.com", "💰 New Donation",
    "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Amount:</strong> ₦$amount");

  $success = "Thank you for your support!";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Give | GCM</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<style>
    body { font-family: sans-serif; padding: 2rem; background: #f8f9fc; }
    form { background: white; padding: 20px; border-radius: 10px; width: 400px; max-width: 90%; }
    input, button { width: 100%; padding: 10px; margin-bottom: 1rem; border-radius: 6px; border: 1px solid #ccc; }
    button { background: #007BFF; color: white; border: none; }
  </style>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="text-center text-success">Give to God's Care Missions</h2>
    <?php if (isset($success)): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <form method="POST" class="mx-auto mt-4 p-4 bg-white shadow rounded" style="max-width:500px;">
      <div class="mb-3">
        <label>Full Name</label>
        <input type="text" name="name" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Email Address</label>
        <input type="email" name="email" class="form-control" required />
      </div>
      <div class="mb-3">
        <label>Amount (₦)</label>
        <input type="number" name="amount" class="form-control" required />
      </div>
      <button class="btn btn-success w-100">Give Now</button>
    </form>
  </div>
</body>
</html>
