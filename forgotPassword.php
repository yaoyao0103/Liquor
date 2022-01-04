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
    <title> Forgot Password page </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="css/style.php">
</head>

<body>
    <?php
        if(!$username && !$userId){ // not logged in
            if($_POST['resetBtn']){ // get form from resetBtn
                //get form info
                $username = $_POST['username'];
                $email = $_POST['email'];

                //make sure info provided
                if($username){
                    if($email){
                        $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
                        $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'"); // query for matching username
                        $numrows = mysqli_num_rows($query); // number of result
                        if($numrows == 1){ // have one result
                            // get info about account
                            $row = mysqli_fetch_assoc($query);
                            $dbEmail = $row['email'];
                            
                            // make sure the email is correct
                            if($email == $dbEmail){
                                // generate password
                                $password = rand(); // random password
                                $password = md5($password); // encryption
                                $password = substr($password, 0, 15); // cut to length 15

                                // update db with new password
                                mysqli_query($conn, "UPDATE users SET password='$password' WHERE username='$username'");
                                
                                // make sure the password was changed
                                $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'"); // query for matching username and password
                                $numrows = mysqli_num_rows($query); // number of result
                                if($numrows == 1){ // have one result
                                    $url = "https://diary-mail-node-app.herokuapp.com/mail";
                                    $data = array('email' => $email, 'subject' => 'new password', 'text' => $password);

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
                                        $errormsg = "New password has been sent to your email.";
                                    }
                                    $errormsg = "Your password has been reset.";
                                }
                                else
                                    $errormsg = "An error has ocurred and the password was not reset.";

                            }
                            else   
                                $errormsg = "You enter the wrong email address.";
                        }
                        else
                            $errormsg = "The username was not found.";
                    }
                    else
                        $errormsg = "Please enter your email.";

                }
                else
                    $errormsg = "Please enter your username.";
            }
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
                    <form class='forgot-Password-htm' method='post' action='./forgotPassword.php'>
                        <div class='group'>
                            <label for='user' class='label'>Username</label>
                            <input id='user' type='text' class='input' name='username'>
                        </div>
                        <div class='group'>
                            <label for='email' class='label'>Email Address</label>
                            <input id='email' type='text' class='input' name='email'>
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
    ?>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/tilt.js"></script>
</body>

</html>