<?php


$photo = $_FILES['photo'];



$photo_name = basename($photo['name']);// Ovaj basename sluzi za to da nam se prikaze samo ime slike a ne samu putanju do slike 

$photo_path = 'member_photos/' .  $photo_name;

$allowed_ext = ['jpg', 'jpeg', 'png', 'gif']; // allowed_ext nam oznacava dozvoljene ekstenzije slike

$ext = pathinfo($photo_name, PATHINFO_EXTENSION); // Ovo nam sluzi za preuzimanje ekstenzije naseg fajla

if(in_array($ext, $allowed_ext) && $photo['size'] < 2000000) {
    move_uploaded_file($photo['tmp_name'], $photo_path);

   echo json_encode(['success' => true, 'photo_path' => $photo_path]);  // ovo znaci vracanje poruke java scriptu


} else {
    echo json_encode (['success' => false, 'error' => 'Invalid file']);
};