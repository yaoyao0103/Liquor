<?php
    function generateNewCard($sql, $tag, $search){
        $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd");
        mysqli_set_charset($conn, "utf8");

        $num_per_page = 12;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1; // default page = 1
        }

        $start_form = ($page-1)*$num_per_page; // the start row of liquors table

        $limitedSql = $sql." limit $start_form, $num_per_page"; // sql
        $liquor_result = mysqli_query($conn, $limitedSql); // get result    
        //$query = mysqli_query($conn, "SELECT * FROM liquors as L, tag as T WHERE L.id = T.liquor_id and T.tag_name = 'Highball'");
        $numrows = mysqli_num_rows($liquor_result); // number of result
        if($numrows >=1){
            $result = "<div class=\"wrapper\" id = \"all_card\">";
            while ($liquor = mysqli_fetch_array($liquor_result, MYSQLI_ASSOC)) {
                $cname = $liquor['cname'];
                $ename = $liquor['ename'];
                $id = $liquor['ID'];
                $photoURL = $liquor['photoURL'];
                $ename = str_replace("-","'",$ename);

                //get ingredients
                $ingredientSql = "select * from new_ingredient where liquor_id = $id";
                $ingredients = mysqli_query($conn, $ingredientSql);
                $tempIngredient = [];
                while($row = mysqli_fetch_assoc($ingredients))
                    $tempIngredient[] = $row; 
                $ingredientsJSON = json_encode($tempIngredient);
                //get tags
                $tagSql = "select * from new_tag where liquor_id = $id";
                $tags = mysqli_query($conn, $tagSql);
                $tempTag = [];
                while($row = mysqli_fetch_assoc($tags))
                    $tempTag[] = $row; 
                $tagsJSON = json_encode($tempTag);
                
                $liquorJSON = json_encode($liquor);
        
                
                $commentSql = "SELECT * FROM comments WHERE id = $id";
                $commentResult = mysqli_query($conn, $commentSql);
                $tempComment = [];
                while($row = mysqli_fetch_assoc($commentResult))
                    $tempComment[] = $row; 
                $commentJSON = json_encode($tempComment);

                $content_front = "<div class=\"card\" data-tilt data-tilt-max=\"10\" style=\"background-image: url($photoURL) \" onclick='toggle($liquorJSON, $ingredientsJSON, $tagsJSON, $commentJSON)'> 
                <div class=\"card_content\" > 
                    <a href='#' class=\"play-button\"> 
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
                $cnameArray = preg_split('/(?<!^)(?!$)/u', $cname );
                $result .= $content_front;
                foreach($cnameArray as $char){
                    $result .= "<span><span>$char</span><span>$char</span></span>";
                }
                $result .= $content_back;
            }
            $liquor_result = mysqli_query($conn, $sql);
            $total_records = mysqli_num_rows($liquor_result); // 總資料筆數
            $total_pages = ceil($total_records/$num_per_page); // 總頁數

            $result .= "<div class = 'page_btn_div'>";
            if($search!=''){
                if($page != 1) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?search=$search&page=".($page-1)."'\"><<</button>"; // not in page 1 then show pervious page button
                
                for($i = 1; $i <= $total_pages; $i++){
                    if($i!=$page){
                        $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?search=$search&page=$i'\">".$i."</button>" ; //切換頁數button
                    }
                    else{
                        $result .= "<button class = 'page_btn present_page' onclick=\"location.href='index.php?search=$search&page=$i'\">".$i."</button>" ; //當下頁面
                    }
                }
                if($page != $total_pages) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?search=$search&page=".($page+1)."'\">>></button>"; // not in the last page then show next page button
               
                 
            }
            else if($tag!=''){
                if($page != 1) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?tag=$tag&page=".($page-1)."'\"><<</button>"; // not in page 1 then show pervious page button
                
                for($i = 1; $i <= $total_pages; $i++){
                    if($i!=$page){
                        $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?tag=$tag&page=$i'\">".$i."</button>" ; //切換頁數button
                    }
                    else{
                        $result .= "<button class = 'page_btn present_page' onclick=\"location.href='index.php?tag=$tag&page=$i'\">".$i."</button>" ; //當下頁面
                    }
                }
                if($page != $total_pages) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?tag=$tag&page=".($page+1)."'\">>></button>"; // not in the last page then show next page button
            }
            else{
                if($page != 1) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?page=".($page-1)."'\"><<</button>"; // not in page 1 then show pervious page button
                
                for($i = 1; $i <= $total_pages; $i++){
                    if($i!=$page){
                        $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?page=$i'\">".$i."</button>" ; //切換頁數button
                    }
                    else{
                        $result .= "<button class = 'page_btn present_page' onclick=\"location.href='index.php?page=$i'\">".$i."</button>" ; //當下頁面
                    }
                }
                if($page != $total_pages) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?page=".($page+1)."'\">>></button>"; // not in the last page then show next page button
               
            }
            $result .= "</div>";
                $result .= "</div>";
        }
        else{
            $result = "no result";
        }
        echo $result;
    }
	function generateUserRecipeCard($sql, $tag, $search){
        $conn = mysqli_connect("us-cdbr-east-04.cleardb.com", "be18b79a8458a8", "350744db", "heroku_54df87b96adc2fd");
        mysqli_set_charset($conn, "utf8");
		
        $num_per_page = 12;
        
		if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1; // default page = 1
        }

        $start_form = ($page-1)*$num_per_page; // the start row of liquors table

        $limitedSql = $sql." limit $start_form, $num_per_page"; // sql
		
        $liquor_result = mysqli_query($conn, $limitedSql); // get result    
        //$query = mysqli_query($conn, "SELECT * FROM liquors as L, tag as T WHERE L.id = T.liquor_id and T.tag_name = 'Highball'");
        $numrows = mysqli_num_rows($liquor_result); // number of result
		
        if($numrows >=1){
            $result = "<div class=\"wrapper\" id = \"all_card\">";
            while ($liquor = mysqli_fetch_array($liquor_result, MYSQLI_ASSOC)) {
                $cname = $liquor['cname'];
                $ename = $liquor['ename'];
                $id = $liquor['ID'];
                $photoURL = $liquor['photoURL'];
                $ename = str_replace("-","'",$ename);

                //get ingredients
                $ingredientSql = "select * from new_ingredient where liquor_id = $id";
                $ingredients = mysqli_query($conn, $ingredientSql);
                $tempIngredient = [];
                while($row = mysqli_fetch_assoc($ingredients))
                    $tempIngredient[] = $row; 
                $ingredientsJSON = json_encode($tempIngredient);
                //get tags
                $tagSql = "select * from new_tag where liquor_id = $id";
                $tags = mysqli_query($conn, $tagSql);
                $tempTag = [];
                while($row = mysqli_fetch_assoc($tags))
                    $tempTag[] = $row; 
                $tagsJSON = json_encode($tempTag);
                
                $liquorJSON = json_encode($liquor);
        
                
                $commentSql = "SELECT * FROM comments WHERE id = $id";
                $commentResult = mysqli_query($conn, $commentSql);
                $tempComment = [];
                while($row = mysqli_fetch_assoc($commentResult))
                    $tempComment[] = $row; 
                $commentJSON = json_encode($tempComment);

                $content_front = "<div class=\"card\" data-tilt data-tilt-max=\"10\" style=\"background-image: url($photoURL) \" onclick='toggle($liquorJSON, $ingredientsJSON, $tagsJSON, $commentJSON)'> 
                <div class=\"card_content\" > 
                    <a href='#' class=\"play-button\"> 
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
                $cnameArray = preg_split('/(?<!^)(?!$)/u', $cname );
                $result .= $content_front;
                foreach($cnameArray as $char){
                    $result .= "<span><span>$char</span><span>$char</span></span>";
                }
                $result .= $content_back;
            }
            $liquor_result = mysqli_query($conn, $sql);
            $total_records = mysqli_num_rows($liquor_result); // 總資料筆數
            $total_pages = ceil($total_records/$num_per_page); // 總頁數

            $result .= "<div class = 'page_btn_div'>";
            if($search!=''){
                if($page != 1) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?search=$search&page=".($page-1)."'\"><<</button>"; // not in page 1 then show pervious page button
                
                for($i = 1; $i <= $total_pages; $i++){
                    if($i!=$page){
                        $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?search=$search&page=$i'\">".$i."</button>" ; //切換頁數button
                    }
                    else{
                        $result .= "<button class = 'page_btn present_page' onclick=\"location.href='index.php?search=$search&page=$i'\">".$i."</button>" ; //當下頁面
                    }
                }
                if($page != $total_pages) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?search=$search&page=".($page+1)."'\">>></button>"; // not in the last page then show next page button
               
                 
            }
            else if($tag!=''){
                if($page != 1) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?tag=$tag&page=".($page-1)."'\"><<</button>"; // not in page 1 then show pervious page button
                
                for($i = 1; $i <= $total_pages; $i++){
                    if($i!=$page){
                        $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?tag=$tag&page=$i'\">".$i."</button>" ; //切換頁數button
                    }
                    else{
                        $result .= "<button class = 'page_btn present_page' onclick=\"location.href='index.php?tag=$tag&page=$i'\">".$i."</button>" ; //當下頁面
                    }
                }
                if($page != $total_pages) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?tag=$tag&page=".($page+1)."'\">>></button>"; // not in the last page then show next page button
            }
            else{
                if($page != 1) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?page=".($page-1)."'\"><<</button>"; // not in page 1 then show pervious page button
                
                for($i = 1; $i <= $total_pages; $i++){
                    if($i!=$page){
                        $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?page=$i'\">".$i."</button>" ; //切換頁數button
                    }
                    else{
                        $result .= "<button class = 'page_btn present_page' onclick=\"location.href='index.php?page=$i'\">".$i."</button>" ; //當下頁面
                    }
                }
                if($page != $total_pages) $result .= "<button class = 'page_btn' onclick=\"location.href='index.php?page=".($page+1)."'\">>></button>"; // not in the last page then show next page button
               
            }
            $result .= "</div>";
                $result .= "</div>";
        }
        else{
            $result = "no result";
        }
        echo $result;
    }
?>