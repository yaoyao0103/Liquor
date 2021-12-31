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
    <title> Recipe_ingredient page </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="css/style.php">
</head>

<body>
    
	<?php
        // if($userID && $username){ // already logged in
        //     if($isAdmin){ // is administrator
        //         header("Location: admin.php");
        //     }
        //     else{ // is not administrator
        //         header("Location: member.php");
        //     }
        // }
        // else{ // not logged in
		if($_POST['nextBtn']){ // get form from activateBtn

                //get form info
                setcookie('errormsg','');
                $cname = $_POST['cname'];
                $ename = $_POST['ename'];
                $photoURL = $_POST['photoURL']; 
				$detail =$_POST['detail'];
                $ingredient_quantity=$_POST['ingredient_quantity'];
                $tag_quantity=$_POST['tag_quantity'];

                setcookie('cname', $_POST['cname']);
                setcookie('ename', $_POST['ename']);
                setcookie('photoURL', $_POST['photoURL']);
                setcookie('detail', $_POST['detail']);
                setcookie('ingredient_quantity', $_POST['ingredient_quantity']);
                setcookie('tag_quantity', $_POST['tag_quantity']);

                if($cname){
                    if($ename){
                        if($photoURL){
                            if($detail){
                            //     $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd");
                            //     $query = mysqli_query($conn,"SELECT * FROM liquors WHERE cname='$cname'");
                            //     $numrows = mysqli_query($query);
                            //     if($numrows == 0){
                            //         $query = mysqli_query($conn,"SELECT * FROM liquors WHERE ename='$ename'");
                            //         $numrows = mysqli_query($query);
                            //         if($numrows == 0){
                            //             $query = mysqli_query($conn,"SELECT * FROM liquors WHERE photoURL='$photoURL'");
                            //             $numrows = mysqli_query($query);
                            //             if($numrows == 0){
                            //                 $query = mysqli_query($conn,"SELECT * FROM liquors WHERE detail='$detail'");
                            //                 $numrows = mysqli_query($query);
                            //                 if($numrows == 0){
                            //                     // mysqli_query($conn, "INSERT INTO users VALUES(
                            //                     // '', '$cname', '$ename','$detail','$photoURL'
                            //                     // )");
                            //                 }
                            //                 else{
                            //                     setcookie('errormsg','There is already a recipe with the detail.');
                            //                     header("Location: recipe_liquor.php");
                            //                 }
                            //             }
                            //             else{
                            //                 setcookie('errormsg','There is already a recipe with the photo.');
                            //                 header("Location: recipe_liquor.php");
                            //             }
                            //         }
                            //         else{
                            //             setcookie('errormsg','There is already a recipe with the English name.');
                            //             header("Location: recipe_liquor.php");
                            //         }
                            //     }
                            //     else{
                            //         setcookie('errormsg','There is already a recipe with the Chinese name.');
                            //         header("Location: recipe_liquor.php");
                            //     }
                            }
                            else{
                                setcookie('errormsg','You must enter the detial to new a recipe.');
                                header("Location: recipe_liquor.php");
                            }
                        }
                        else{
                                setcookie('errormsg','You must enter the photo to new a recipe.');
                                header("Location: recipe_liquor.php");
                        }
                    }
                    else{
                        setcookie('errormsg','You must enter the English name to new a recipe.');
                        header("Location: recipe_liquor.php");
                    } 
                }
                else{
                        setcookie('errormsg','You must enter the Chinese name to new a recipe.');
                        header("Location: recipe_liquor.php");
                    }
			}
            else
                setcookie('errormsg','');
            
            echo
            "<div>
                <div class='header-dark'>";

            include_once 'navigation_logged_in.php';
			
            // form
            ?>
            <div class='userInfo-wrap'>
                <div class='userInfo-html'>
                    <div class='userInfo-form'>
                        <form class='recipe-htm' method='post' action='./successfullySubmit.php'>
							<div class='notice'><?php$errormsg?></div>
                            <?php
                            for($i=0;$i<$ingredient_quantity;$i++){
                                ?>
                                    <div class='group'>
                                        <label for='ingredient' class='label'>ingredient <?php echo $i+1?>:</label>
                                        <input id='ingredient' type='text' class='input' name='ingredient<?php echo $i?>'>
                                    </div>
                                    <div class='group'>
                                        <label for='volumn' class='label'>volume <?php echo $i+1?></label>
                                        <input id='volume' type='text' class='input' name='volume<?php echo $i?>'>
                                    </div>
                                <?php
                            }
                            ?>
                            <?php
                            for($i=0;$i<$tag_quantity;$i++){
                                ?>
                                    <div class='group'>
                                        <label for='ingredient' class='label'>Tag <?php echo $i+1?>:</label>
                                        <input id='ingredient' type='text' class='input' name='tag<?php echo $i?>'>
                                    </div>
                                <?php
                            }
                            ?>

                      
                                    <div class='group top-space'>
                                <input type='submit' class='button' value='submit' name='finishBtn'>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <?php
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