<?php

require_once 'config.php';


if($_SERVER['REQUEST_METHOD'] =="POST" ) {
    $member_id = $_POST['member'];
    $trener_id = $_POST['trainer'];

    $sql = "UPDATE members SET trener_id = ? WHERE member_id = ?";
    $run = $conn->prepare($sql);
    $run->bind_param("ii", $trener_id, $member_id) ;

    $run->execute();


    //Set a session variable with a success message
    $_SESSION['success_message'] = "Trener uspesno dodat clanu";

    //Redirect to the admin_dashboard.php page
    header("location: admin_dashboard.php");
    exit();

}
