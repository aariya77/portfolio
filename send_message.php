<?php
// Database connection
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "aariya";  
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize input
  $name    = $conn->real_escape_string($_POST['name']);
  $email   = $conn->real_escape_string($_POST['email']);
  $message = $conn->real_escape_string($_POST['message']);
  $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $email, $message);
  if ($stmt->execute()) {
    echo "Message sent successfully!";
  } else {
    echo "Error: " . $stmt->error;
  }
  $stmt->close();
}
$conn->close();
?>
