<?php
    session_start();
    $liquorId = $_SESSION['liquorId'];
    $userId = $_SESSION['userId'];
    $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
    mysqli_set_charset($conn,"utf8");
    $sql = "INSERT INTO bookmarks VALUES($liquorId, $userId)";
    $flag = mysqli_query($conn, $sql);
    if($flag){
        $favoriteSql = "SELECT count(*) FROM bookmarks WHERE id = $liquorId";
        $favoriteResult = mysqli_query($conn, $favoriteSql);
        $favoriteResult = $favoriteResult->fetch_array();
        $totalFavorite = intval($favoriteResult[0]);
        echo $totalFavorite;
    }  
    else{
        echo false;
    }
?>