<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['fname'] . $_POST['lname'];
    $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        echo "Email and password cannot be empty.";
        exit;
    }


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $host = 'localhost'; 
    $db = 'php'; 
    $user = 'root';
    $pass = 'Munyuamwangi4$';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        echo "Connected successfully to the database.";

        $query = "INSERT INTO users (username, email, password) VALUES (:username,:email, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            header('Location: home.html');
            exit();
        } else {
            echo "Registration failed.";
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
