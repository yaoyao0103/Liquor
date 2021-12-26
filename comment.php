<?php
    session_start();
    $userId = $_SESSION['userId'];
    $username = $_SESSION['username'];
    $isAdmin = $_SESSION['isAdmin'];
    $liquorId = $_SESSION['liquorId'];


    $comment = $_POST['comment'];
    $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
    mysqli_set_charset($conn,"utf8");
    $sql = "INSERT INTO comments VALUES($liquorId, '' , $userId, '$username', '$comment')";
    $flag = mysqli_query($conn, $sql);
    if($flag){
        echo "success";
    }
    else{
        echo $flag;
        echo $liquorId . "-" . $userId . "-" . $username . "-" . $comment;
    }
?>