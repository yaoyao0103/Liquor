<?php
    error_reporting(0);
    require('functions.php');

    //session get
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
    <title> Home page </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="./js/collapzion.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/style.php">
    <script type="text/javascript">
		jQuery(function($){
			$('#btncollapzion').Collapzion({
                _child_attribute:[
                    {
                    'label':'New Recipes',
                    'url':'recipe_liquor.php',
                    'icon':'&#xE150;'
                    },
                    /*{
                    'label':'Edit Recipes',
                    'url':'#',
                    'icon':'&#xE873;'
                    },*/
                    {
                        'label':'My Recipes',
                        'url':'myRecipe.php',
                        'icon':'&#xea60;'
                    },
                    {
                        'label':'My Favorite',
                        'url':'myFavorite.php',
                        'icon':'&#xea60;'
                    },
                    <?php
                    if($isAdmin){
                        echo "{
                            'label':'Manage Recipes',
                            'url':'manage.php',
                            'icon':'&#xea60;'
                            },";
                    }
                    ?>
                ],
                _main_btn_color:'#208f8f;',
                _child_btn_color:'#eee;',
				
            });
		});

        
	</script>
</head>

<body>
    <div id="preloader"></div>
    <div class = "load-wrapper">
    <!-- <div> -->
        <div class='header-dark' id='blur'>
            <?php
                include_once 'navigation.php';
            ?>
            <div class="dropdown" id ="sort-btn">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" id = "origin_sort" href="">Original</a>
                    <a class="dropdown-item" id = "like_sort" href="">Likes</a>
                    <a class="dropdown-item" id = "favorite_sort" href="">Favorites</a>
                </div>
            </div>
            <?php
                $favorite = "";
                $keyword = "";
                $tag = "";
                $sortBy = "";
                if($_GET['tag']){ // show by tags
                    $tag = $_GET['tag'];
                    $sql = "SELECT L.* from liquors as L, tag as T where T.liquor_id = L.id and T.tag_name = '$tag'";
                }
                else if($_GET['search']){  // show by search
                    $keyword = $_GET['search'];
                    $sql = "SELECT distinct L.* from liquors as L, tag as T, ingredient as I where T.liquor_id = L.id and I.liquor_id = L.id and (T.tag_name like '%$keyword%' or L.cname like '%$keyword%' or L.ename like '%$keyword%' or I.name like '%$keyword%')"; 
                }
                else{ // show all card
                    $sql = "SELECT * from liquors"; 
                }
                if($_GET['sort']){  // show above sorted result
                    $sortBy = $_GET['sort'];
                    if($sortBy == "favorites") $sql = "SELECT distinct L.*, count( B.userId ) as favorites from ($sql) as L natural join bookmarks as B GROUP BY L.id ORDER By $sortBy"; 
                    else if($sortBy == "likes") $sql = "SELECT distinct L.*, count( B.userId ) as likes from ($sql) as L natural join likes as B GROUP BY L.id ORDER By $sortBy"; 
                }
                generateCard($sql, $tag, $keyword, $sortBy);
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
            </div>
            <div class = 'popup_comment'>
                <div class = 'all_comment' id = 'all_comment'>
                </div>
                <?php
                    if($username && $userId) echo 
                        '<div class = "comment_input">
                        <form method = "POST" action = "./comment.php">
                            <input type="text" id = "comment_text" name = "comment">
                            <input type="submit" id = "comment_btn" name = "comment_btn" >
                        </form>
                    </div>';
                ?>
            </div>
            <?php
                if($username && $userId) echo 
                    '<div class = "likeBtn" id = "likeBtn" onclick="setLikeColor()">
                        <span class = "heart" id = "heart"></span>
                        <p id = "total_like">0</p>
                    </div>
                    <div><i class = "material-icons comment_icon" id = "comment_icon">&#xe0ca;</i></div>
                    <div onclick="setBookmarkColor()"><i class = "material-icons bookmark_icon" id = "bookmark_icon">&#xe98b;</i></div>
                    ';
                
            ?>
            
            
            
            <div class = 'popup_btn_group'>
                <?php
                    if($isAdmin) echo "<div id = 'popup_delete_btn' class = 'popup_btn'><a href='#' onclick = 'delete()'>Delete</a></div>
                    <div id = 'popup_edit_btn' class = 'popup_btn'><a href='#' onclick = 'edit()'>Edit</a></div>";
                ?>
                <div id = 'popup_close_btn' class = 'popup_btn'><a href='#' onclick = 'unToggle()'>Close</a></div>
            </div>
        </div>
    </div>
    
    <div id="btncollapzion" class="btn_collapzion"></div>
    
    <script>
        function toggle(liquor, ingredients, tags, comments, totalLike){
            console.log("totalLike: "  + totalLike);
            $.ajax({
                type: "POST",
                url: "setLiquorIdSession.php",
                data:{
                    liquorId: liquor.id
                },
                success: function(data){
                    console.log(data);
                },
                error: function (error) {
                    console.log('error; ' + eval(error));
                }}
            );
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

            let commentStr = "<div id = 'comment_header'>Comment</div><hr class = 'comment_header_hr'/>";
            for(let comment of comments){
                commentStr += "<div class = 'comment'> \
                        <div class = 'comment_username'><span>" + comment.username + "</span><div class = 'commentLikeBtn' onclick='setCommentLikeColor(this)' value = " + comment.commentId + "> \
                    <span class = 'commentHeart'></span> \
                    <p id = 'comment_total_like'>" + comment.total_like + "</p></div></div> \
                        <div class = 'comment_content'>" + comment.comment + "</div> \
                    </div> \
                    <hr class = 'comment_hr'/> ";
            }
            document.getElementById('popup_ingredients').innerHTML = ingredientStr;
            document.getElementById('popup_detail').innerHTML = "<span>" + liquor.detail.substr(0,3) + "</span><br/>" + liquor.detail.substr(3);
            document.getElementById('popup_tags').innerHTML = "<span>Tags:</span><br/>  " + tagStr;
            document.getElementById('popup_img').setAttribute("src", liquor.photoURL);
            document.getElementById('all_comment').innerHTML = commentStr;
            document.getElementById('total_like').innerHTML = totalLike;
            
        }

        function unToggle(){
            let blur = document.getElementById('blur');
            let popup = document.getElementById('popup');
                blur.classList.toggle('active');
                popup.classList.toggle('active');
            let element = document.getElementById("heart");
            element.classList.remove("redBackground");
            element = document.getElementById("bookmark_icon");
            element.style.color = "#8a93a0";
        }

        function setLikeColor(){
            let element = document.getElementById("heart");
            element.classList.add("redBackground");
            $.ajax({
                type: "POST",
                url: "setLiquorLike.php",
                success: function(data){
                    console.log(data);
                },
                error: function (error) {
                    console.log('error; ' + eval(error));
                }}
            );
        }

        function setCommentLikeColor(obj){
            let id = $(obj).attr("value");
            $(obj).children().first().addClass( "redBackground" );
            $.ajax({
                type: "POST",
                url: "setCommentLike.php",
                data:{
                    commentId: id
                },
                success: function(data){
                    console.log(data);
                },
                error: function (error) {
                    console.log('error; ' + eval(error));
                }}
            );
        }

        function setBookmarkColor(){
            let element = document.getElementById("bookmark_icon");
            element.style.color = "white";
            $.ajax({
                type: "POST",
                url: "setBookmark.php",
                success: function(data){
                    console.log(data);
                },
                error: function (error) {
                    console.log('error; ' + eval(error));
                }}
            );
        }


    </script>

    <script>
        let loader = document.getElementById("preloader");
        window.addEventListener("load", function(){
            $("#preloader").fadeOut(1000);
            $(".load-wrapper").fadeIn(1000);

            //const likeBtn = document.getElementById('likeBtn');
            const likeBtn = document.getElementById('likeBtn');
            const heart = document.getElementById('heart');
            likeBtn.addEventListener('mousemove',() => {
                heart.classList.add('heratPop')
            });
            likeBtn.addEventListener('mouseout',() => {
                heart.classList.remove('heratPop')
            });

        });
        document.getElementById("origin_sort").href = window.location.href;
        document.getElementById("like_sort").href = window.location.href + "&sort=likes";
        document.getElementById("favorite_sort").href = window.location.href + "&sort=favorites";
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/tilt.js"></script>
</body>

</html>