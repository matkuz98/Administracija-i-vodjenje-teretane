<?php
require_once 'config.php';

// Podaci novog admina
$username = 'mata';
$password = 'mata123';

// Hashiranje lozinke
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Priprema SQL upita

$sql = "INSERT INTO admins (username, password) VALUES (?, ?)"
$run = $conn->prepare($sql);
$run->bind_param("ss", $username, $hashed_password);
$run->execute();


echo "Novi admin je uspješno dodat.";



$conn->close();