<?php
// handleForm.php
include_once 'DBConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $db = new DBConnection();
    $conn = $db->getConnection();

    $query = "INSERT INTO register (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error registering user.";
    }
} else {
    echo "Invalid request method.";
}
?>
