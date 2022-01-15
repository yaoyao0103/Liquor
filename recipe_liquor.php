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
    <link rel="stylesheet" href="css/style.php">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/tilt.js"></script>
	
	
</body>

</html>