<?php
    error_reporting(0);
    session_start();
    // get session info
    $userId = $_SESSION['userId'];
    $username = $_SESSION['username'];
    $isAdmin = $_SESSION['isAdmin'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Logout page </title>
    </head>
    <body>
        <?php
            if($userId && $username){ // already logged in
                session_destroy();
            }
            header("Location: index.php");
        ?>

    </body>
</html>