<?php

    include 'DB.php';

    $conn = connectToDB("lab8");

    $username = $_GET['username'];

    //next query allows SQL Injection!
    $sql = "SELECT * FROM lab8_user WHERE userName = :username";

    $stmt = $conn->prepare($sql);
    //$stmt->bindParam(":userName", $username);
    $stmt->execute( array(":username"=> $username ));
    $record = $stmt->fetchall(PDO::FETCH_ASSOC);

    //print_r($record);

    echo json_encode($record);

?>