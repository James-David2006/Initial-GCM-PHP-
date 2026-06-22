<!-- contact.php -->
<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Contact Us</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header class="hero-section">
    <div class="hero-text">
      <h1>Contact Us</h1>
    </div>
  </header>

  <section class="about-preview">
    <form method="post">
      <input type="text" name="name" placeholder="Name" required /><br /><br />
      <input type="email" name="email" placeholder="Email" required /><br /><br />
      <textarea name="message" placeholder="Your message" required></textarea><br /><br />
      <button type="submit" class="btn-primary">Send</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['message']);
      if ($stmt->execute()) echo "<p>Message sent successfully!</p>";
      else echo "<p>Error sending message.</p>";
    }
    ?>
  </section>
</body>
</html>
