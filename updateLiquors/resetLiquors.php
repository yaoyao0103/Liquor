<?php
    $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
    mysqli_set_charset($conn,"utf8");
    mysqli_query($conn, "delete from liquors");
    mysqli_query($conn, "delete from ingredient");
    mysqli_query($conn, "delete from tag");
?>