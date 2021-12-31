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
    $userId = $_SESSION['userId'];
    if($_POST['nextBtn']){
        setcookie('errormsg','');
        try{
            $cname = $_POST['cname'];
            $ename = $_POST['ename'];
            $photoURL = $_POST['photoURL']; 
			$detail =$_POST['detail'];
            $ingredients=$_POST['ingredients'];
            $tags=$_POST['tags'];
            $ingredients;
            // $cname = $_COOKIE['cname'];
            // $ename = $_COOKIE['ename'];
            // $photoURL = $_COOKIE['photoURL'];
            // $detail = $_COOKIE['detail'];
            // $ingredient_quantity = $_COOKIE['ingredient_quantity'];
            // $tag_quantity = $_COOKIE['tag_quantity'];
            if($cname){
                    if($ename){
                        if($photoURL){
                            if($detail){
                                if($ingredients){
                                    if($tags){
                                        $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd");
                                        $mysql ="SELECT * FROM liquors WHERE cname='$cname'";
                                        $query = mysqli_query($conn,$mysql);
                                        $numrows = mysqli_num_rows($query);
                                        if($numrows == 0){//no same cname
                                            $mysql ="SELECT * FROM liquors WHERE ename='$ename'";
                                            $query = mysqli_query($conn,$mysql);
                                            $numrows = mysqli_num_rows($query);
                                                if($numrows == 0){//no same ename
                                                    $mysql ="SELECT * FROM liquors WHERE photoURL='$photoURL'";
                                                    $query = mysqli_query($conn,$mysql);
                                                    $numrows = mysqli_num_rows($query);
                                                    if($numrows == 0){//no same photoURL
                                                        $mysql ="SELECT * FROM liquors WHERE detail='$detail'";
                                                        $query = mysqli_query($conn,$mysql);
                                                        $numrows = mysqli_num_rows($query);
                                                        if($numrows == 0){//no same detail
                                                        }
                                                        else{
                                                            setcookie('errormsg','There is already a recipe with the detail.');
                                                            header("Location: recipe_liquor.php");
                                                        }
                                                    }
                                                    else{
                                                        setcookie('errormsg','There is already a recipe with the photo.');
                                                        header("Location: recipe_liquor.php");
                                                    }
                                                }
                                                else{
                                                    setcookie('errormsg','There is already a recipe with the English name.');
                                                    header("Location: recipe_liquor.php");
                                                }
                                        }
                                        else{
                                            setcookie('errormsg','There is already a recipe with the Chinese name.');
                                            header("Location: recipe_liquor.php");
                                        }
                                    }
                                    else{
                                        setcookie('errormsg','You must enter the tag for new a recipe.');
                                        header("Location: recipe_liquor.php");
                                    }
                                }
                                else{
                                    setcookie('errormsg','You must enter the ingredients for new a recipe.');
                                    header("Location: recipe_liquor.php");
                                }
                            }
                            else{
                                setcookie('errormsg','You must enter the detail for new a recipe.');
                                header("Location: recipe_liquor.php");
                            }
                        }
                        else{
                            setcookie('errormsg','You must enter the photoURL for new a recipe.');
                            header("Location: recipe_liquor.php");
                        }
                    }
                    else{
                        setcookie('errormsg','You must enter the English name for new a recipe.');
                        header("Location: recipe_liquor.php");
                    }
            }
            else{
                setcookie('errormsg','You must enter the Chinese name for new a recipe.');
                header("Location: recipe_liquor.php");
            }
                            
           
            $ingredient_volume= array();//put ingredient:volume
            $ingredient_array = array();
            $volume_array = array();
            $tag_array = array();
            $ingredient_volume = explode('+',$ingredients);
            $length = count($ingredient_volume);
            $tmp=array();
            for($i=0;$i<$length;++$i){
                $tmp=explode(":",$ingredient_volume[$i]);
                array_push($ingredient_array,$tmp[0]);
                array_push($volume_array,$tmp[1]);
            }
            
            
            // for($i=0; $i<$ingredient_quantity; ++$i){
            //     array_push($ingredient_array, $_POST['ingredient'.$i]);
            //     array_push($volume_array, $_POST['volume'.$i]);
            // }
            $tag_array=explode("#",$tags);
           
            // for($i=0; $i<$tag_quantity; $i++){
            //     array_push($tag_array, $_POST['tag' . $i]);
            // }

            // echo print_r($ingredient_array);
            // echo print_r($volume_array);
            // echo print_r($tag_array);
            // echo $length;
            // echo $cname;
            // echo $ename;
            // echo $photoURL;
            // echo $detail;
            // print_r($ingredients);
            // print_r($tags);
            // print_r($ingredient_volume_array);
            // print_r($ingredient_array); 
            // //print_r($ingredient_volume_array);
            // print_r($volume_array); 
            // print_r($tag_array);
            
            echo "<script>alert('success');window.location.replace('./index.php');</script>";
            
            $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd");
            mysqli_query($conn,"INSERT INTO new_liquors  VALUES ('','$cname','$ename','$detail','$photoURL','5','0')");
             
            ?>
            <script>console.log("success")</script>
            <?php
            $mysql = "SELECT * FROM new_liquors WHERE cname = '$cname'";
            $query = mysqli_query($conn, $mysql);
            $firstrow = mysqli_fetch_assoc($query);
            $id = $firstrow['ID'];
            echo $id;
            ?>
            <script>console.log("success")</script>
            <?php
            // echo $id;
            
            for($i=0; $i<count($ingredient_array); ++$i){
                $iname = $ingredient_array[$i];
                $vol = $volume_array[$i];
                $mysql = "INSERT INTO new_ingredient VALUES ('', $id', '$iname', '$vol', '0')";
                $query = mysqli_query($conn, $mysql);
                 echo "<script>alert('nice')</script>"; 
            }
            for($i=0; $i<count($tag_array); ++$i){
                $tname = $tag_array[$i];
                $mysql = "INSERT INTO new_tag VALUES ('', '$id', '$tname', '0')";
                $query = mysqli_query($conn, $mysql);
            }
            
            ?>
            <script>console.log("success")</script>
            <?php
            echo "<script>alert('Success');
            window.location.replace('./index.php');</script>";
        }catch(Exception $e){
            echo "<script>alert('Error: ".$e."');</script>";
            header("Location:recipe_liquor.php");
        }
    }
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/tilt.js"></script>
	
	
</body>

</html>