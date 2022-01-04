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
    <title> Login page </title>
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

            if($_POST['loginBtn']){ // get form from loginBtn 
                $username = $_POST['username']; // get username in form
                $password = $_POST['password']; // get password in form
                
                //make sure info provided
                if($username){ 
                    if($password){
                        $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
                        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'"); // query for matching username
                        $numrows = mysqli_num_rows($query); // number of result
                        if($numrows == 1){ // have one matching data
                            $row = mysqli_fetch_assoc($query); // get this row
                            // get some value of this row
                            $dbId = $row['userId'];
                            $dbUsername = $row['username'];
                            $dbPassWord = $row['password'];
                            $dbActive = $row['active'];
                            $dbIsAdmin = $row['isAdmin'];

                            if($password == $dbPassWord){ // check the password is correct
                                if($dbActive == 1){ // is activated
                                    //set session info
                                    $_SESSION['userId'] = $dbId;
                                    $_SESSION['username'] = $dbUsername;
                                    $_SESSION['isAdmin'] = $dbIsAdmin;

                                    header("Location: index.php");          
                                }
                                else
                                    header("Location: activate.php");
                            }
                            else
                                $errormsg = "You didn't enter the correct password.";
                        }
                        else
                            $errormsg = "The username you entered was not found.";
                    }
                    else
                        $errormsg = "You must enter your password.";
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
                        <form class='sign-in-htm' method='post' action='./login.php'>
                            <div class='notice'>$errormsg</div>
                            <div class='group'>
                                <label for='user' class='label'>Username</label>
                                <input id='user' type='text' class='input' name = 'username'>
                            </div>
                            <div class='group'>
                                <label for='pass' class='label'>Password</label>
                                <input id='pass' type='password' class='input' data-type='password' name='password'>
                            </div>
                            <div class='group top-space'>
                                <input type='submit' class='button' value='Sign In' name='loginBtn' >
                            </div>
                            <div class='hr'></div>
                            <div class='foot-lnk'>
                                <a href='./forgotPassword.php'>Forgot Password?</a>
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