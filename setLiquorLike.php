<?php
    session_start();
    $liquorId = $_SESSION['liquorId'];
    $userId = $_SESSION['userId'];
    $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
    mysqli_set_charset($conn,"utf8");
    $sql = "INSERT INTO likes VALUES($liquorId, $userId)";
    $flag = mysqli_query($conn, $sql);
    if($flag){
        echo "success!";
    }  
    else{
        echo "error!";
    }
?>