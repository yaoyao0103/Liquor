<?php
/*
 * 範例教學
 * https://blog.reh.tw/archives/662/
 */
    header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8

    if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求

        $cname = $_POST["cname"]; //取得 nickname POST 值
        $ename = $_POST["ename"]; //取得 nickname POST 值
        $photoUrl = $_POST["photoUrl"]; //取得 nickname POST 值
        $tags = $_POST["tags"]; //取得 nickname POST 值
        $ingredient = $_POST["ingredient"]; //取得 nickname POST 值
        $detail = $_POST["detail"]; //取得 nickname POST 值

        $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
        mysqli_set_charset($conn,"utf8");
        /*$chars = str_split($ename);
        $tempename = array();
        foreach ($chars as $char) {
            if($char == '\''){
                array_push($tempename, "\\");
            }
            array_push($tempename, $char);
        }*/
        $tempEname = str_replace("'", "-", $ename);
        $index = strpos($detail,'延伸閱讀');
        if(strpos($detail,'延伸閱讀')){
            $index = strpos($detail,'延伸閱讀');
            $detail = substr($detail, 0, $index);
        }
        mysqli_query($conn, "INSERT INTO liquors VALUES('', '$cname', '$tempEname', '$detail', '$photoUrl')"); // query for matching username*/
        //$query = mysqli_query($conn, "SELECT * FROM liquors WHERE cname='$cname'"); // query for matching username
        
        //ingredient
        $query = mysqli_query($conn, "SELECT * FROM liquors WHERE cname='$cname'");
        $numrows = mysqli_num_rows($query); // number of result
        if($numrows >=1){
            foreach ($query as $row){
                $liquor_id = $row['id'];
                
                //ingredient
                foreach($ingredient as $key => $value){
                    mysqli_query($conn, "INSERT INTO ingredient VALUES('', '$liquor_id', '$key', '$value') ");
                }
                
                foreach($tags as $name){
                    $temp = str_replace("'", "-", $name);
                    mysqli_query($conn, "INSERT INTO tag VALUES('', '$liquor_id', '$temp') ");
                }
            }
            echo $cname . "success";
        }
        else{
            echo $cname . "error";
        }

        
    }

?>