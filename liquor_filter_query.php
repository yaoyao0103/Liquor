
<?php
    error_reporting(0);
    require('functions.php');

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
    <title> Recipe_liquor page </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="css/style.php">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="./js/collapzion.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
    
	<?php
        $errormsg = $_COOKIE['errormsg'];
            $cur_liquor = $_POST['add_liquor_Btn'];
            $selected = $_POST['selected']." ".$cur_liquor;
            $prev_mysql = $_POST['prev_mysql'];
            $prev_sql = $_POST['prev_sql'];
            $from_base = $_POST['from_base'];
            // if($selected == ""){
            //     echo hello;
            // }else{
            //     echo ass;
            // }
            echo
            "<div>
                <div class='header-dark'>";
                    include_once 'navigation.php';
            ?>
                    <div class="dropdown" id ="base-btn">
                        <form class='recipe-htm' method='post' action='./liquor_filter_query.php'>
                            <div class = "ingredients">
                                <label for='cname' class='label' style = "font-weight: bold;">Selected Liquor: </label>
                                <input type="hidden" name="selected" value="<?php echo $selected; ?>">
                                <label class='label'>
                                    <?php echo $selected;?>
                                
                                </label><br/>
                                <div class = "space"></div>
                                <label for='more-ingred' class='label' style = "font-weight: bold;">可搭配材料: </label><br/>
                                
                                    <?php
                                        $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd");
                                        mysqli_set_charset($conn,"utf8");
                                        $mysql = "";
                                        $sql = "";
                                        if($from_base == "1"){
                                            $mysql ="SELECT DISTINCT name FROM ingredient WHERE name NOT LIKE '%".$cur_liquor."%' and liquor_id in (SELECT DISTINCT liquor_id FROM ingredient WHERE name LIKE '%".$cur_liquor."%')";
                                            $sql ="SELECT * FROM liquors WHERE id in (SELECT DISTINCT liquor_id FROM ingredient WHERE name LIKE '%".$cur_liquor."%')";
                                        }elseif($from_base == "0"){
                                            $mysql = "".$prev_mysql."and liquor_id in (SELECT DISTINCT liquor_id FROM ingredient WHERE name LIKE '%".$cur_liquor."%')"." and name NOT LIKE '%".$cur_liquor."%'";
                                            $sql = "".$prev_sql."and id in (SELECT DISTINCT liquor_id FROM ingredient WHERE name LIKE '%".$cur_liquor."%')";
                                        }
                                        // echo $mysql;
                                        $query = mysqli_query($conn,$mysql);    
                                        $num = mysqli_num_rows($query);
                                        // echo $num;
                                        while($row = mysqli_fetch_assoc($query)){
                                    ?>
                                        <input type='submit' class='button' value='<?php echo $row['name'];?>' name='add_liquor_Btn'>   
                                        <input type="hidden" name="from_base" value="0">
                                        <input type="hidden" name="prev_sql" value="<?php echo $sql?>">
                                    <?php
                                        }
                                        
                                    ?>
                                    <input type='hidden' value="<?php echo $mysql;?>" name='prev_mysql'>
                                    
                            </div>
                        </form>

                    </div>
                    <div class = "space"></div>
                    
                    <?php
                        generateThreeCard($sql, '','','');//生成酒譜卡片 一次三張
                    ?>
                    <?php
            echo  
                "</div>
            </div>";
        // }
    ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/tilt.js"></script>
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
                
            <div class = "likeBtn" id = "likeBtn" <?php if($username && $userId) echo "onclick='setLikeColor()'"; ?>>
                <span class = "heart" id = "heart"></span>
                <p id = "total_like">0</p>
            </div>
            <div class = "comment_icon">
                <i class = "material-icons" id = "comment_icon">&#xe0ca;</i>
                <p id = "total_comment">0</p>
            </div>
            <div class = "bookmark_icon" id = "bookmark" <?php if($username && $userId) echo "onclick='setBookmarkColor()'"; ?>>
                <i class = "material-icons" id = "bookmark_icon">&#xe98b;</i>
                <p id = "total_favorite">0</p>
            </div>
        
            
            
            
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
	<!-- <script>
        function toggle(liquor, ingredients, tags, comments){
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
            document.getElementById('total_like').innerHTML = liquor.totalLike;
            document.getElementById('total_favorite').innerHTML = liquor.totalFavorite;
            document.getElementById('total_comment').innerHTML = liquor.totalComment;
            if(liquor.liked){
                let element = document.getElementById("heart");
                element.classList.add("redBackground");
                document.getElementById("likeBtn").setAttribute("onclick", "");
            }
            if(liquor.favorited){
                let element = document.getElementById("bookmark_icon");
                element.style.color = "white";
                document.getElementById("bookmark").setAttribute("onclick", "");
            }
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
            document.getElementById("likeBtn").setAttribute("onclick", "setLikeColor()");
            document.getElementById("bookmark").setAttribute("onclick", "setBookmarkColor()");
        }
        function setLikeColor(){
            let element = document.getElementById("heart");
            element.classList.add("redBackground");
            document.getElementById("likeBtn").setAttribute("onclick", "");
            $.ajax({
                type: "POST",
                url: "setLiquorLike.php",
                success: function(data){
                    if(data) document.getElementById("total_like").innerHTML = data;
                    else alert("You have already liked");
                },
                error: function (error) {
                    console.log(error);
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
                    if(data) console.log(data);
                    else alert("You have already liked");
                },
                error: function (error) {
                    console.log(error);
                }}
            );
        }
        function setBookmarkColor(){
            let element = document.getElementById("bookmark_icon");
            element.style.color = "white";
            document.getElementById("bookmark").setAttribute("onclick", "");
            $.ajax({
                type: "POST",
                url: "setBookmark.php",
                success: function(data){
                    if(data) document.getElementById("total_favorite").innerHTML = data;
                    else alert("You have already favorited");
                },
                error: function (error) {
                    console.log(error);
                }}
            );
        }
    </script> -->

    <!-- <script>
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
        
        let currentURL = new URL(window.location.href);
        let params = currentURL.searchParams;
        let front = currentURL.protocol  + "//" + currentURL.hostname + currentURL.pathname;
        let origin_params = new URLSearchParams(currentURL.search);
        let like_params = new URLSearchParams(currentURL.search);
        let favorite_params = new URLSearchParams(currentURL.search);
        origin_params.delete('sort');
        like_params.set('sort', 'likes');
        favorite_params.set('sort', 'favorites');
        if(origin_params.toString()) document.getElementById("origin_sort").href = front + "?" + origin_params.toString();
        else document.getElementById("origin_sort").href = front;
        document.getElementById("like_sort").href = front + "?" + like_params.toString();
        document.getElementById("favorite_sort").href = front + "?" + favorite_params.toString();
        
    </script> -->
	
</body>

</html>