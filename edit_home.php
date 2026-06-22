<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}
include '../config.php';

// Update hero text
if (isset($_POST['update_hero'])) {
  $heading = $_POST['heading'];
  $subheading = $_POST['subheading'];
  $button_text = $_POST['button_text'];
  $button_link = $_POST['button_link'];

  $stmt = $conn->prepare("UPDATE home_hero SET heading=?, subheading=?, button_text=?, button_link=? WHERE id=1");
  $stmt->bind_param("ssss", $heading, $subheading, $button_text, $button_link);
  $stmt->execute();
}

// Upload slider image
if (isset($_POST['upload_slide']) && $_FILES['slide_img']['name']) {
  $img_name = $_FILES['slide_img']['name'];
  $tmp_name = $_FILES['slide_img']['tmp_name'];
  $path = "../uploads/" . basename($img_name);
  if (move_uploaded_file($tmp_name, $path)) {
    $stmt = $conn->prepare("INSERT INTO home_slides (image) VALUES (?)");
    $stmt->bind_param("s", $img_name);
    $stmt->execute();
  }
}

// Get current hero data
$hero = $conn->query("SELECT * FROM home_hero WHERE id=1")->fetch_assoc();
$slides = $conn->query("SELECT * FROM home_slides ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Homepage</title>
  <link rel="stylesheet" href=\"../style.css\">
  <style>
    body { font-family: 'Segoe UI', sans-serif; padding: 2rem; background: #f5f9ff; }
    h2 { color: #007BFF; }
    form { background: #fff; padding: 1rem; margin-bottom: 2rem; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    input, textarea { width: 100%; padding: 8px; margin: 5px 0; border-radius: 5px; border: 1px solid #ccc; }
    button { background: #007BFF; color: #fff; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer; }
    img { max-width: 150px; margin: 10px; border-radius: 8px; }
    .btn-back { margin-top: 10px; display: inline-block; background: #6c757d; color: white; padding: 6px 12px; border-radius: 5px; text-decoration: none; }
  </style>
</head>
<body>

  <h2>🏠 Edit Homepage Hero</h2>
  <form method="post">
    <label>Heading:</label>
    <input type="text" name="heading" value="<?= htmlspecialchars($hero['heading']) ?>" required>
    <label>Subheading:</label>
    <textarea name="subheading" rows="3"><?= htmlspecialchars($hero['subheading']) ?></textarea>
    <label>Button Text:</label>
    <input type="text" name="button_text" value="<?= $hero['button_text'] ?>">
    <label>Button Link:</label>
    <input type="text" name="button_link" value="<?= $hero['button_link'] ?>">
    <button type="submit" name="update_hero">Save Hero Section</button>
  </form>

  <h2>🖼️ Upload Slider Image</h2>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="slide_img" accept="image/*" required>
    <button type="submit" name="upload_slide">Upload Image</button>
  </form>

  <h3>📸 Current Slides:</h3>
  <div>
    <?php while($s = $slides->fetch_assoc()): ?>
      <img src="../uploads/<?= htmlspecialchars($s['image']) ?>" alt="Slide">
    <?php endwhile; ?>
  </div>

  <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>

</body>
</html>
