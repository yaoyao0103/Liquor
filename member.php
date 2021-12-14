<?php
    error_reporting(0);
    session_start();
    $userId = $_SESSION['userId'];
    $username = $_SESSION['username'];
    $isAdmin = $_SESSION['isAdmin'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Member page </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="css/style.php">
</head>

<body>
<div>
        <div class='header-dark' id='blur'>
            <?php
                include_once 'navigation.php';
                //include_once 'ex_cards.php';
                if($_GET['tag']){ // show by tags
                    $tag = $_GET['tag'];
                    $sql = "select L.* from liquors as L, tag as T where T.liquor_id = L.id and T.tag_name = '$tag'";
                }
                else if($_GET['search']){
                    $keyword = $_GET['search'];
                    $sql = "select distinct L.* from liquors as L, tag as T, ingredient as I where T.liquor_id = L.id and I.liquor_id = L.id and (T.tag_name like '%$keyword%' or L.cname like '%$keyword%' or L.ename like '%$keyword%' or I.name like '%$keyword%')"; 
                    $tag = "";
                }
                else{ // show all card
                    $sql = "select * from liquors"; 
                    $tag = "";
                }
                generateCard($sql, $tag);
            ?>
        </div>

        <!-- liquor information -->
        <div id='popup'>  
            <div class = 'popup_img'>
                <img id = 'popup_img'>
            </div>
            <div class = 'popup_content'>
                <div id = 'popup_cname'></div>
                <div id = 'popup_ename'></div>
                <div id = 'popup_ingredients'></div>
                <div id = 'popup_detail'></div>
                <div id = 'popup_tags'></div>
                <div id = 'popup_btn'><a href='#' onclick = 'unToggle()'>Close</a></div>
            </div>
        </div>
    </div>
    
    <script>
        function toggle(liquor, ingredients, tags){
            let blur = document.getElementById('blur');
            blur.classList.toggle('active');
            let popup = document.getElementById('popup');
            popup.classList.toggle('active');
            document.getElementById('popup_cname').innerHTML = liquor.cname;
            document.getElementById('popup_ename').innerHTML = liquor.ename.replace("-", "'");

            let ingredientStr = "<ul>";
            for(let row of ingredients){
                ingredientStr += "<li>"+ row.name + ": " + row.volume;
            }
            ingredientStr += "</ul>";
            let tagStr = "";
            for(let tag of tags){
                tagStr += "<a href = 'index.php?tag=" + tag.tag_name +  "'>" + tag.tag_name.replace("-", "'") + "</a>"
            }
            document.getElementById('popup_ingredients').innerHTML = ingredientStr;
            document.getElementById('popup_detail').innerHTML = liquor.detail;
            document.getElementById('popup_tags').innerHTML = "Tags: " + tagStr;
            document.getElementById('popup_img').setAttribute("src", liquor.photoURL);
        }

        function unToggle(){
            let blur = document.getElementById('blur');
            blur.classList.toggle('active');
            let popup = document.getElementById('popup');
            popup.classList.toggle('active');
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/tilt.js"></script>
</body>

</html>