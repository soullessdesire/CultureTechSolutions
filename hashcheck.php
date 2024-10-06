<?php
$password = "www.com.com";
$pass_hash = password_hash($password, PASSWORD_DEFAULT);

echo password_verify($password, $pass_hash);

