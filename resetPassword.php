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
            if($isAdmin){ // is administrator
                header("Location: admin.php");
            }
            else{ // is not administrator
                header("Location: member.php");
            }
        }
        else{ // not logged in
            echo
            "<div>
                <div class='header-dark'>";

            include_once 'navigation_member.php';

            // form
            echo
            "<div class='userInfo-wrap'>
                <div class='userInfo-html'>
                    <div class='userInfo-form'>
                        <form class='reset-Password-htm' method='post' action='./resetPassword.php'>
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