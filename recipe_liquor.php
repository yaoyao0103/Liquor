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
    <title> Recipe_liquor page </title>
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
                    'label':'Report',
                    'url':'https://docs.google.com/presentation/d/1aU7WgXoyAtvMXwCqQaGf0PyrA-4TvF4Bg7ZTkZgcCOw/edit#slide=id.gd1b45eafd5_0_6',
                    'icon':'&#xf1c6;'
                    },
                    {
                    'label':'Random Recipe',
                    'url':'randomChoose.php',
                    'icon':'&#xe043;'
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
                        'icon':'&#xe92c;'
                    },
                    {
                        'label':'My Favorite',
                        'url':'myFavorite.php',
                        'icon':'&#xe87d;'
                    },";
                    }
                    
                    if($isAdmin){
                        echo "{
                            'label':'Manage Recipes',
                            'url':'manage.php',
                            'icon':'&#xe869;'
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
        if(!($userId&&$username)){
            header("Location: index.php");
        }
    ?>
    
	<?php
        $errormsg = $_COOKIE['errormsg'];
        // if($userID && $username){ // already logged in
        //     if($isAdmin){ // is administrator
        //         header("Location: admin.php");
        //     }
        //     else{ // is not administrator
        //         header("Location: member.php");
        //     }
        // }
        // else{ // not logged in
            echo
            "<div>
                <div class='header-dark'>";

            include_once 'navigation.php';

            // form
            ?>
            <div class='userInfo-wrap1'>
                <div class='userInfo-html'>
                    <div class='userInfo-form'>
                        <form class='recipe-htm' method='post' action='./successfullySubmit.php'>
							<div class='notice'><?php echo $errormsg ?></div>
                            
                            <div class='group'>
                                <label for='cname' class='label'>Chinese name</label>
                                <input id='cname' type='text' class='input' name='cname'>
                            </div>
                            <div class='group'>
                                <label for='ename' class='label'>Engilsh name</label>
                                <input id='ename' type='text' class='input' name='ename'>
                            </div>
							<div class='group'>
                                <label for='photoURL' class='label'>PhotoURL</label>
                                <input id='photoURL' type='text' class='input' name='photoURL'>
                            </div>
							<div class='group'>
                                <label for='detail' class='label'>Detail</label>
                                <input id='detail' type='text' class='input' name='detail'>
                            </div>
                            <div class='group'>
                                <label for='ingredient_quantity' class='label'>Ingredient <br>
                                (please input in type +ingredient:volumn and no space ex:+water:10ml+sugar:5g)</label>
                                <input id='ingredients' type='text' class='input' name='ingredients' >
                            </div>
                            <div class='group'>
                                <label for='tag_quantity' class='label'>Tag <br>(please input in tpye #tag ex:#hot)</label>
                                <input id='tags' type='text' class='input' name='tags'>
                            </div>
                            <div class='group top-space'>
                                <input type='submit' class='button' value='next' name='nextBtn'>
                            </div>
                        </form>
                    </div>
                </div><?php
            echo  
                "</div>
            </div>";
    ?>

    <div id="btncollapzion" class="btn_collapzion"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/tilt.js"></script>
	
	
</body>

</html>