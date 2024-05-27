<?php
require_once 'config.php';


if(isset($_GET['what'])) {
    if($_GET ['what'] == 'members') {
        $sql = "SELECT * FROM members";
        $csv_cols = [
            "member_id" ,
            "first_name" ,
            "last_name" ,
            "email", 
            "phone_number" ,
            "training_plan_id" ,
            "trainer_id" ,
            "created_at"];

    } else if($_GET['what'] == 'trainers') {
        $sql = "SELECT * FROM trainers";
        $csv_cols = [
            "trainer_id",
            "first_name",
            "last_name",
            "email",
            "phone_number",
            "created_at"];
    } else {
        echo "Podaci nisu moguci";
        die();
    }

    $run = $conn->query($sql);
    $results= $run->fetch_all(MYSQLI_ASSOC);

// Promjena formata brojeva telefona u tekst
foreach ($results as &$result) {
    foreach ($result as &$value) {
        // Provjerite je li vrijednost numerička
        if (is_numeric($value)) {
            // Formatirajte broj telefona kao tekst
            $value = "'$value";
        }
    }
}



    $output = fopen('php://output', 'w');//Ovo oznacava da radimo output fajla dok fopen oznacava kreiranje novog fajla(trenutnog) a w pisanje tog samog fajla
    header ('Content-Type: text/csv');
    header ('Content-Disposition: attachment; filename =' . $_GET['what'] . ".csv");

    fputcsv($output, $csv_cols);//Kreiranje kolona

    foreach($results as $result) {
      fputcsv($output, $result);    // Kreiranje rezultata

    



    }

    fclose($output);             //Zatvaranje fajla




}