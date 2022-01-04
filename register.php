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
    <title> Register page </title>
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
            if($_POST['registerBtn']){ // get form from activateBtn

                //get form info
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $retypePassword = $_POST['retypePassword'];

                //make sure info provided
                if($username){
                    if($email){
                        if($password){
                            if($retypePassword){
                                if($password == $retypePassword){
                                    $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
                                    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'"); // query for matching username
                                    $numrows = mysqli_num_rows($query); // number of result
                                    if($numrows == 0){ // have no result: there is no exist the same username

                                        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$email'"); // query for matching email
                                        $numrows = mysqli_num_rows($query); // number of result
                                        if($numrows == 0){ // have no result: there is no exist the same email
                                            $date = date("F d, Y"); // set create date
                                            $code = md5(rand()); // encryption the random verification code
                                            $code = substr($code, 0, 25); // cut to length 25

                                            // query for insert user info
                                            mysqli_query($conn, "INSERT INTO users VALUES(
                                                '', '$username', '$password', '$email', '0', '$code', '$date', '0'
                                            )");
                                            $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'"); // query for matching username
                                            $numrows = mysqli_num_rows($query); // number of result
                                            if($numrows == 1){ // have one result

                                                $url = "https://diary-mail-node-app.herokuapp.com/mail";
                                                $data = array('email' => $email, 'subject' => 'verify code', 'text' => $code);

                                                // use key 'http' even if you send the request to https://...
                                                $options = array(
                                                    'http' => array(
                                                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                                                        'method'  => 'POST',
                                                        'content' => http_build_query($data)
                                                    )
                                                );
                                                $context  = stream_context_create($options);
                                                $result = file_get_contents($url, false, $context);
                                                if ($result === FALSE) { 
                                                    $errormsg = "Something wrong!!";
                                                }
                                                else{
                                                    $errormsg = "You have been registered.";
                                                }

                                            }
                                            else
                                                $errormsg = "An error has occurred. Your account was not created";
                                        }
                                        else
                                            $errormsg = "Their is already a user with that email";
                                    }
                                    else
                                        $errormsg = "Their is already a user with that username";
                                }
                                else
                                    $errormsg = "Your passwords did not match.";
                            }
                            else
                                $errormsg = "You must retype your password to register.";
                        }
                        else
                            $errormsg = "You must enter your password to register.";
                    }
                    else
                        $errormsg = "You must enter your email to register.";
                }  
                else
                    $errormsg = "You must enter your username to register.";
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
                        <form class='sign-up-htm' method='post' action='./register.php'>
                            <div class='notice'>$errormsg</div>
                            <div class='group'>
                                <label for='user' class='label'>Username</label>
                                <input id='user' type='text' class='input' name = 'username'>
                            </div>
                            <div class='group'>
                                <label for='pass' class='label'>Password</label>
                                <input id='pass' type='password' class='input' data-type='password' name = 'password'>
                            </div>
                            <div class='group'>
                                <label for='retype-pass' class='label'>Repeat Password</label>
                                <input id='retype-pass' type='password' class='input' data-type='password' name = 'retypePassword'>
                            </div>
                            <div class='group'>
                                <label for='email' class='label'>Email Address</label>
                                <input id='email' type='text' class='input' name = 'email'>
                            </div>
                            <div class='group top-space'>
                                <input type='submit' name='registerBtn' class='button' value='Sign Up'>
                            </div>
                            <div class='hr'></div>
                            <div class='foot-lnk'>
                                <a href='./login.php'>Already Member?</a>
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