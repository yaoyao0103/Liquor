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
        $errormsg = $_COOKIE['errormsg'];
        
            echo
            "<div>
                <div class='header-dark'>";
                    include_once 'navigation.php';
            ?>
                <div class='userInfo-wrap'>
                    <div class='userInfo-html'>
                        <form class='recipe-htm' method='post' action='./liquor_filter_query.php'>
                            <div class='group'>
                                <label for='cname' class='label'>Select Base Liquor: </label>
                                <select name="add_liquor_Btn" id="base">
                                    <option value="伏特加">伏特加</option>
                                    <option value="蘭姆酒">蘭姆酒</option>
                                    <option value="琴酒">琴酒</option>
                                    <option value="威士忌">威士忌</option>
                                    <option value="龍舌蘭">龍舌蘭</option>
                                    <option value="白蘭地">白蘭地</option>
                                </select>
                                <input type="hidden" name="selected" value="">
                                <input type="hidden" name="from_base" value="1">
                                <input type='submit' class='button' value='Submit' name='submitBtn'>
                            </div>
                        </form>

                    </div>
                </div><?php
            echo  
                "</div>
            </div>";
        // }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/tilt.js"></script>
	
	
</body>

</html>