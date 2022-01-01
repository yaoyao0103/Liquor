<?php
    error_reporting(0);
    require('cardGen.php');

    //session get
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
    //action 0: del, action 1: verify, action 2:
    $action = $_GET['action'];
    $id = $_GET['id'];
    $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd");
    mysqli_set_charset($conn, "utf8");
    if($action == 0){
        $sql = "DELETE FROM new_tag WHERE liquor_id = $id";
        $conn->query($sql);
        $sql = "DELETE FROM new_ingredient WHERE liquor_id = $id";
        $conn->query($sql);
        $sql = "DELETE FROM new_liquors WHERE ID = $id";
        $conn->query($sql);
        echo "<script>alert('Delete Successfully');";
        if($isAdmin){
            echo "window.location.replace('./manage.php');</script>";
        }
        else{
            echo "window.location.replace('./myRecipe.php');</script>";
        }
            
    }else if($action == 1){
        $sql = "UPDATE new_tag SET isVerified = 1 WHERE liquor_id = $id";
        $conn->query($sql);
        $sql = "UPDATE new_ingredient SET isVerified = 1 WHERE liquor_id = $id";
        $conn->query($sql);
        $sql = "UPDATE new_liquors SET isVerified = 1 WHERE ID = $id";
        $conn->query($sql);
        echo "<script>alert('Success');
            window.location.replace('./manage.php');</script>";
    }else if($action == 2){
        $sql = "SELECT * FROM new_liquors WHERE ID=".$id;
        $result = mysqli_query($conn, $sql);
        $liquor;
        foreach($result as $row){
            $liquor = $row;
        }
        $sql = "SELECT * FROM new_ingredient WHERE liquor_id = ".$id;
        $result = mysqli_query($conn, $sql);
        $ingredients = "";
        foreach($result as $row){
            
            $ingredients .= "+".$row['name'].":".$row['volume'];
        }
        $sql = "SELECT * FROM new_tag WHERE liquor_id = ".$id;
        $result = mysqli_query($conn, $sql);
        $tags = "";
        foreach($result as $row){
            $tags .= '#'.$row['tag_name'];
        }
        echo
            "<div>
                <div class='header-dark'>";
                    
            include_once 'navigation.php';
        ?>
            <div class='userInfo-wrap'>
                <div class='userInfo-html'>
                    <div class='userInfo-form'>
                        <form class='recipe-htm' method='post' action='./updatePage.php?id=<?php echo $id?>'>
                            <div class='group'>
                                <label for='cname' class='label'>Chinese name</label>
                                <input id='cname' type='text' class='input' name='cname' value="<?php echo $liquor['cname']?>">
                            </div>
                            <div class='group'>
                                <label for='ename' class='label'>Engilsh name</label>
                                <input id='ename' type='text' class='input' name='ename'value="<?php echo $liquor['ename']?>">
                            </div>
							<div class='group'>
                                <label for='photoURL' class='label'>PhotoURL</label>
                                <input id='photoURL' type='text' class='input' name='photoURL'value="<?php echo  $liquor['photoURL']?>">
                            </div>
							<div class='group'>
                                <label for='detail' class='label'>Detail</label>
                                <input id='detail' type='text' class='input' name='detail'value="<?php echo $liquor['detail']?>">
                            </div>
                            <div class='group'>
                                <label for='ingredient_quantity' class='label'>Ingredient <br>
                                (please input in type +ingredient:volumn and no space ex:+water:10ml+sugar:5g)</label>
                                <input id='ingredients' type='text' class='input' name='ingredients' value="<?php echo $ingredients?>">
                            </div>
                            <div class='group'>
                                <label for='tag_quantity' class='label'>Tag <br>(please input in tpye #tag ex:#hot)</label>
                                <input id='tags' type='text' class='input' name='tags' value='<?php echo $tags?>'>
                            </div>
                            <div class='group top-space'>
                                <input type='submit' class='button' value='update' name='updateBtn'>
                            </div>
                            <div id=updateLiquorId class='id' name='id'style="visibility: hidden;">
                                <?php echo $id ?>
                                
                            </div>
                        </form>
                    </div>
                </div>
                <?php 
            echo  
                "</div>
            </div>";
            }
?>
<script> function update(){
    let id = document.getElementById('updateLiquorId').innerHTML;
    location.href="updatePage.php?id="+id;}
    </script>}
</body>

</html>