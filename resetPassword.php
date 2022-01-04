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
    <title> Reset Password page </title>
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
            if($_POST['resetBtn']){ // get form from activateBtn

                //get form info
                $password = $_POST['password'];
                $newPassword = $_POST['newPassword'];
                $retypePassword = $_POST['confirmPassword'];

                //make sure info provided
                if($password){
                    if($newPassword){
                        if($retypePassword){
                            if($newPassword == $retypePassword){
                                $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB

                                // query for insert user info
                                $flag = mysqli_query($conn, "UPDATE users SET password = '$newPassword' where username = '$username'");
                                if($flag) // have one result
                                    $errormsg = "Your password has been reset.";
                                else
                                    $errormsg = "An error has occurred. Your account was not created";
                            }
                            else
                                $errormsg = "You must retype correct password.";
                        }
                        else
                            $errormsg = "You must retype your new password.";
                    }
                    else
                        $errormsg = "You must enter your new password";
                }
                else
                    $errormsg = "You must enter correct password";
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
                        <form class='reset-Password-htm' method='post' action='./resetPassword.php'>
                            <div class='notice'>$errormsg</div>
                            <div class='group'>
                                <label for='user' class='label'>Password</label>
                                <input id='user' type='password' class='input' name='password'>
                            </div>
                            <div class='group'>
                                <label for='email' class='label'>New Password</label>
                                <input id='email' type='password' class='input' name='newPassword'>
                            </div>
                            <div class='group'>
                                <label for='email' class='label'>Confirm Password</label>
                                <input id='email' type='password' class='input' name='confirmPassword'>
                            </div>
                            <div class='group top-space'>
                                <input type='submit' class='button' value='Reset Password' name='resetBtn'>
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