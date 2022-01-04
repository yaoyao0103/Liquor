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
    <title> Activate page </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="css/style.php">
</head>

<body>
    <?php
        if($userID && $username){ // already logged in
            header("Location: index.php");
        }
        else{ // not logged in
            $username = $_GET['user'];
            $code = $_GET['code'];

            if( $_POST['activateBtn']){ // get form from activateBtn

                //get form info
                $username = $_POST['username'];
                $code = $_POST['code'];

                //make sure info provided
                if($username){
                    if($code){
                        $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
                        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'"); // query for matching username
                        $numrows = mysqli_num_rows($query); // number of result
                        if($numrows == 1){ // have on result
                            // get db member info
                            $row = mysqli_fetch_assoc($query);
                            $dbCode = $row['code'];
                            $dbActivate = $row['active'];

                            if($dbActivate == 0){
                                if($dbCode == $code){
                                    mysqli_query($conn, "UPDATE users SET active='1' WHERE username='$username'"); // connect to DB
                                    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'"); // query for matching username
                                    $numrows = mysqli_num_rows($query); // number of result
                                    if($numrows == 1){ // have on result
                                        $errormsg = "Your account has been activated. You may not login.";
                                        $username = "";
                                        $code = "";
                                    }
                                    else
                                        $errormsg = "An error has occurred. Your account was not activated.";
                                }  
                                else
                                    $errormsg = "Your code is incorrect.";

                            }
                            else
                                $errormsg = "This account is already active.";
                        }
                        else
                            $errormsg = "The username you entered was not found.";
                    }
                    else
                        $errormsg = "You must enter your code.";
                }
                else
                    $errormsg = "You must enter your username.";
            }
            else
                $errormsg = "";
            echo
            "<div>
                <div class='header-dark'>";

            include_once 'navigation.php';

            // form
            echo
            "<div class='userInfo-wrap'>
                <div class='userInfo-html'>
                    <div class='userInfo-form'>
                        <form class='activate-htm' method='post' action='./activate.php'>
                            <div class='notice'>$errormsg</div>
                            <div class='group'>
                                <label for='user' class='label'>Username</label>
                                <input id='user' type='text' class='input' name='username' value=$username >
                            </div>
                            <div class='group'>
                                <label for='code' class='label'>Code</label>
                                <input id='code' type='text' class='input' name='code' value=$code >
                            </div>
                            <div class='group top-space'>
                                <input type='submit' class='button' value='Active' name='activateBtn'>
                            </div>
                        </form>
                    </div>
                </div>";
            echo  
                "</div>
            </div>";
        }
    ?>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/tilt.js"></script>
</body>

</html>