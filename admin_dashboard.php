<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}
include '../config.php';

// Get counts
$sermons = $conn->query("SELECT COUNT(*) FROM sermons")->fetch_row()[0];
$donations = $conn->query("SELECT SUM(amount) FROM donations")->fetch_row()[0] ?? 0;
$contacts = $conn->query("SELECT COUNT(*) FROM contacts")->fetch_row()[0];
$pastors = $conn->query("SELECT COUNT(*) FROM pastors")->fetch_row()[0];
$events = $conn->query("SELECT COUNT(*) FROM events")->fetch_row()[0];

// Get admin info
$admin = $conn->query("SELECT * FROM admins WHERE username='{$_SESSION['admin']}'")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard | GCM</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <style>
    body {
      background-color: #f5f9ff;
      font-family: 'Segoe UI', sans-serif;
    }
    .dashboard-header {
      background: #0d6efd;
      color: white;
      padding: 1rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .admin-info {
      display: flex;
      align-items: center;
    }
    .admin-info img {
      border-radius: 50%;
      width: 50px;
      margin-right: 10px;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .card-title {
      font-size: 1rem;
      color: #666;
    }
    .value {
      font-size: 2rem;
      font-weight: bold;
      color: #0d6efd;
    }
    .sidebar {
      padding: 2rem;
    }
    .sidebar a {
      display: block;
      padding: 0.75rem;
      margin-bottom: 0.5rem;
      background: #eaf0ff;
      color: #0d6efd;
      border-radius: 10px;
      text-decoration: none;
    }
    .sidebar a:hover {
      background: #d6e3ff;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="dashboard-header">
    <div class="admin-info">
      <img src="../uploads/<?= $admin['photo'] ?? 'default.png' ?>" alt="Profile">
      <div>
        <h4 class="mb-0"><?= $admin['full_name'] ?></h4>
        <small>Welcome Admin👑, <?= $_SESSION['admin'] ?></small>
      </div>
    </div>
    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
  </div>

  <div class="container-fluid">
    <div class="row mt-4">

      <!-- Sidebar Menu -->
      <div class="col-md-3 sidebar">
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="edit_profile.php">👤 Edit Profile</a>
        <a href="change_password.php">🔑 Change Password</a>
        <a href="view_log.php">📜 View Audit Log</a>
        <a href="export_contacts.php">📥 Export Contacts (CSV)</a>
        <a href="export_donations.php">📥 Export Donations (CSV)</a>
        <a href="../index.html" target="_blank">🌐 View Site</a>
      </div>

      <!-- Dashboard Analytics -->
      <div class="col-md-9">
        <div class="row g-4">

          <div class="col-md-6 col-lg-4">
            <div class="card p-4">
              <p class="card-title">📖 Sermons</p>
              <div class="value"><?= $sermons ?></div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="card p-4">
              <p class="card-title">🎤 Pastors</p>
              <div class="value"><?= $pastors ?></div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="card p-4">
              <p class="card-title">📅 Events</p>
              <div class="value"><?= $events ?></div>
            </div>
          </div>

          <div class="col-md-6 col-lg-6">
            <div class="card p-4">
              <p class="card-title">💬 Contacts Received</p>
              <div class="value"><?= $contacts ?></div>
            </div>
          </div>

          <div class="col-md-6 col-lg-6">
            <div class="card p-4">
              <p class="card-title">💰 Total Donations (₦)</p>
              <div class="value"><?= number_format($donations, 2) ?></div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

</body>
</html>