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
    
    if($_POST['updateBtn']){
        setcookie('errormsg','');
        try{
            $cname = $_POST['cname'];
            $ename = $_POST['ename'];
            $photoURL = $_POST['photoURL']; 
			$detail =$_POST['detail'];
            $ingredients=$_POST['ingredients'];
            $tags=$_POST['tags'];
			$id = $_GET['id'];
			echo $cname;
			echo "        ";
			echo $ename;
			echo "        ";
			echo $detail;
			

			?>
			<script>console.log('<?php echo $id ?>')</script>
            <?php
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
                                        mysqli_set_charset($conn,"utf8");
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
            $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd");
            mysqli_set_charset($conn, "utf8");
			mysqli_query($conn,$sql);
			$sql = "UPDATE new_liquors SET cname =$cname,ename=$ename,detail=$detail,photoURL=$photoURL,isVerified=0 WHERE ID=".$id;
			mysqli_query($conn,$sql);
            ?>
            
            <?php
            $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd");
            mysqli_set_charset($conn, "utf8");
			mysqli_query($conn,$sql);
            for($i=1; $i<count($ingredient_array); ++$i){
                $iname = $ingredient_array[$i];
                $vol = $volume_array[$i];
                $mysql = "INSERT INTO new_ingredient VALUES ('', '$id', '$iname', '$vol', '0')";
                $query = mysqli_query($conn, $mysql);
            }
			$sql="DELETE FROM new_tag WHERE  liquor_id=$id";
			mysqli_query($conn,$sql);
            for($i=1; $i<count($tag_array); ++$i){
                $tname = $tag_array[$i];
                $mysql = "INSERT INTO new_tag VALUES ('', '$id', '$tname', '0')";
                $query = mysqli_query($conn, $mysql);
            }
            
			
            ?>
            <script>console.log("success")</script>
            <?php
            echo "<script>alert('Update Successfully');
            window.location.replace('./myRecipe.php');</script>";
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