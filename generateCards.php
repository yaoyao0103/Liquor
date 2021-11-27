<?php
    $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd"); // connect to DB
    mysqli_set_charset($conn,"utf8");
    $query = mysqli_query($conn, "SELECT * FROM liquors as L, tag as T WHERE L.id = T.liquor_id and T.tag_name = 'Cocktail'");
    $numrows = mysqli_num_rows($query); // number of result
    if($numrows >=1){
        echo "<div class=\"wrapper\" id = \"all_card\">";
        foreach($query as $liquor){
            $cname = $liquor['cname'];
            $ename = $liquor['ename'];
            $photoURL = $liquor['photoURL'];
            $content_front = "<div class=\"card\" data-tilt data-tilt-max=\"10\" style=\"background-image: url($photoURL)\"> 
            <div class=\"card_content\"> 
                <a class=\"play-button\"> 
                <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 50 50\"> 
                    <path d=\"M42.7,42.7L25,50L7.3,42.7L0,25L7.3,7.3L25,0l17.7,7.3L50,25L42.7,42.7z\" class=\"polygon\"></path> 
                    <polygon points=\"27.5,9 27.5,19 30,21 30,41 20,41 20,21 22.5,19 22.5,9\"></polygon> 
                </svg> 
                </a> 
                <div class=\"card_content_Name\"> 
                <h3 class=\"roll-up\">";
            $content_back = "</h3> 
                    <p class=\"text-reveal\"> 
                    <span> 
                        <span>$ename</span> 
                    </span> 
                    <span> 
                        <span><span>$ename</span></span> 
                    </span> 
                    </p> 
                </div> 
                </div> 
            </div>";
            $cnameArray = mb_str_split($cname);
            echo $content_front;
            foreach($cnameArray as $char){
                echo "<span><span>$char</span><span>$char</span></span>";
            }
            echo $content_back;
        }
        echo "</div>";
    }
    else{
        echo "no result";
    }
?>