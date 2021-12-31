<?php
    session_start();
    $_SESSION['liquorId'] = $_POST['liquorId'];
    echo $_SESSION['liquorId'];
?>