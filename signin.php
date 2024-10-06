<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $usernm_or_email = $_POST['username'];
    $password = $_POST['password'];


    echo "{$usernm_or_email}" . "<br/>";
    echo "{$password}" . "<br/>";

    $host = "localhost";
    $username = 'root';
    $pass = 'Munyuamwangi4$';
    $db = "php";
    $charset = "utf8mb4";

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";



    try {
        $pdo = new PDO($dsn,$username,$pass);
        echo "Connection Successful";

        $query = "SELECT username, password FROM users WHERE username=:username OR email=:email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $usernm_or_email);
        $stmt->bindParam(':email', $usernm_or_email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            if(password_verify($password, $result['password '])){
                header('Location: home.html');
            }else {
                echo "You have provided invalid credentials";
            }

        }else {
            echo "<br/>";
            echo "username =>" . $result['username'] . "<br/>";
            echo "password =>" . $result['password'] . "<br/>";
            echo "no users found" . "<br/>";
        }

    }catch(PDOException $e){
        echo $e->getMessage();
    }
    

}