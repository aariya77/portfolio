<?php
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1) connect
    $conn = new mysqli('localhost', 'root', '', 'aariya');
    if ($conn->connect_error) {
        $msg = 'DB Error: ' . $conn->connect_error;
    } else {
        // 2) grab & simple-escape
        $n = $conn->real_escape_string($_POST['name']   ?? '');
        $e = $conn->real_escape_string($_POST['email']  ?? '');
        $t = $conn->real_escape_string($_POST['message']?? '');
        // 3) insert
        if ($n && $e && $t) {
            $sql = "INSERT INTO messages (name,email,message)
                    VALUES ('$n','$e','$t')";
            $msg = $conn->query($sql)
                 ? "Thanks, <strong>$n</strong>! We got your message."
                 : "Insert Error: " . $conn->error;
        } else {
            $msg = 'Please fill in all fields.';
        }
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<head>
  <title>Socials - Aariya Maharjan</title>
  <link rel="stylesheet" href="socials.css" />
</head>
<body>
  <header>
    <h1>AARIYA MAHARJAN</h1>
    <div class="nav">
  <a href="index.html">Home</a>
  <a href="qualification.html">Qualifications</a>
  <a href="socials.php">Socials</a>
  <a href="pcv.html">CV</a>
</div>

  </header>
  <div class="main">
    <h2>Connect With Me</h2>

    <!-- Social Links Section -->
    <div class="social-links">
      <a href="https://www.instagram.com/aariya.aa" target="_blank" class="social-card instagram">
        <img src="img/ig.jpg" alt="Instagram">
        <span>@aariya.aa</span>
      </a>
      <a href="mailto:aariyamaharjan06@gmail.com" target="_blank" class="social-card gmail">
        <img src="img/gm.jpg" alt="Gmail">
        <span>aariyamaharjan06@gmail.com</span>
      </a>
      <a href="https://www.facebook.com/aarya.maharjan.35" target="_blank" class="social-card facebook">
        <img src="img/fb.jpg" alt="Facebook">
        <span>facebook.com/your.profile</span>
      </a>
      <div class="location-card">
        <img src="img/lo.jpg" alt="Location">
        <p><strong>Country:</strong> Nepal<br><strong>State:</strong> Bagmati Province<br><strong>City:</strong> Lalipur</p>
      </div>
      <div class="contact-form">
        <h3>Send a Message</h3>

        <?php if ($msg): ?>
          <div class="feedback <?= strpos($msg,'Error')!==false||strpos($msg,'fill')!==false?'error':'' ?>">
            <?= $msg ?>
          </div>
        <?php endif; ?>
        <form action="socials.php" method="post">
          <input type="text" name="name" placeholder="Your Name" required>
          <input type="email" name="email" placeholder="Your Email" required>
          <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
          <button type="submit">Send</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

