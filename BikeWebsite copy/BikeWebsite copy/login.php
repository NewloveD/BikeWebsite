<?php
include 'config.php';

session_start();
$db = new mysqli('localhost', 'your_username', 'your_password', 'CampusBike');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // Use password hashing in real apps

    $stmt = $db->prepare("SELECT * FROM Users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['user_id'] = $user['UserID'];
        header("Location: home.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>
