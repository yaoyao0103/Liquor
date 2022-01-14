<?php
    error_reporting(0);
    require('cardGen.php');

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
                    'label':'Random Recipe',
                    'url':'randomChoose.php',
                    'icon':'&#xea60;'
                    },
                    {
                    'label':'Recipe Filter',
                    'url':'liquor_filter.php',
                    'icon':'&#xea60;'
                    },
                    <?php
                    if($userId && $username){
                        echo "
                    {
                    'label':'New Recipes',
                    'url':'recipe_liquor.php',
                    'icon':'&#xE150;'
                    },
                    {
                        'label':'My Recipes',
                        'url':'myRecipe.php',
                        'icon':'&#xea60;'
                    },
                    {
                        'label':'My Favorite',
                        'url':'myFavorite.php',
                        'icon':'&#xea60;'
                    },";
                    }
                    
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
        <div class='header-dark' id='blur'>
            <?php
                include_once 'navigation.php';
            ?>
            <div class="dropdown" id ="sort-btn"></div>
            <?php
                $sql = "select * from new_liquors where isVerified = 0"; 
                $tag = "";
                generateNewCard($sql, $tag, "");
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
                <div id = 'popup_id' style = 'visibility:hidden;'></div>
            </div>
            <!-- <div class = 'popup_comment'>
                
                <?php
                    // if($username && $userId) echo 
                    // '<div class = "comment_input">
                    //     <form method = "POST" action = "./comment.php">
                    //         <input type="text" id = "comment_text" name = "comment">
                    //         <input type="submit" id = "comment_btn" name = "comment_btn" >
                    //     </form>
                    // </div>';
                ?>
            </div> -->
            <div class = 'popup_btn_group'>
                <?php
                    if($isAdmin) echo "
                        <div id = 'popup_delete_btn' class = 'popup_btn' style='background-color: red;'>
                            <a href='#' onclick = 'deleteLiquor()'>Delete</a>
                        </div>
                        <div id = 'popup_Verify_btn' class = 'popup_btn' style='background-color: green;' >
                            <a href='#' onclick = 'verifyLiquor()'>Verify</a>
                        </div>
                    "
                ?>
                <div id = 'popup_close_btn' class = 'popup_btn'><a href='#' onclick = 'unToggle()'>Close</a></div>
            </div>
        </div>
    </div>

    <div id="btncollapzion" class="btn_collapzion"></div>
    
    <script>
        function deleteLiquor(){
            let id = document.getElementById('popup_id').innerHTML;
            location.href="manageLiquorAction.php?id="+id+"&action=0";
        }
        function verifyLiquor(){
            let id = document.getElementById('popup_id').innerHTML;
            location.href="manageLiquorAction.php?id="+id+"&action=1";
        }
        function toggle(liquor, ingredients, tags, comments){
            console.log(comments);
            console.log(liquor);
            $.ajax({
                type: "POST",
                url: "setLiquorIdSession.php",
                data:{
                    liquorId: liquor.ID
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
            document.getElementById('popup_id').innerHTML = liquor.ID;
            

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
                        <div class = 'comment_username'>" + comment.username + "</div> \
                        <div class = 'comment_content'>" + comment.comment + "</div> \
                    </div> \
                    <hr class = 'comment_hr'/> ";
            }
            document.getElementById('popup_ingredients').innerHTML = ingredientStr;
            document.getElementById('popup_detail').innerHTML = "<span>" + liquor.detail.substr(0,3) + "</span><br/>" + liquor.detail.substr(3);
            document.getElementById('popup_tags').innerHTML = "<span>Tags:</span><br/>  " + tagStr;
            document.getElementById('popup_img').setAttribute("src", liquor.photoURL);
            document.getElementById('all_comment').innerHTML = commentStr;
        }

        function unToggle(){
            let blur = document.getElementById('blur');
            let popup = document.getElementById('popup');
                blur.classList.toggle('active');
                popup.classList.toggle('active');
        }


    </script>

    <script>
        let loader = document.getElementById("preloader");
        window.addEventListener("load", function(){
            $("#preloader").fadeOut(1000);
            $(".load-wrapper").fadeIn(1000);
        });
        
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/tilt.js"></script>
</body>

</html>