<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv=”Content-Type” content=”text/html;” charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        header("Content-Type:text/html; charset=utf-8");
        $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
        mysqli_set_charset($conn,"utf8");
        $query = mysqli_query($conn, "SELECT T.tag_name FROM liquors as L, tag as T WHERE L.cname = '野格炸彈' and L.id = T.liquor_id");
        foreach ($query as $row){
            echo $row['tag_name'] . "<br>";
        }
    ?>
</body>
</html>