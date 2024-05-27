<?php

require_once 'config.php';

$username = 'ivan';
$password = 'sifra123';



echo $password;


$hashed_password = password_hash($password, PASSWORD_DEFAULT);



echo $hashed_password1;


$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
$run = $conn->prepare($sql);
$run->bind_param("ss", $username, $hashed_password);
$run->execute();


