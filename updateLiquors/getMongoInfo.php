<?php
    error_reporting(0);
?>
<!DOCTYPE html>
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
        <script>
            function express(){  
                fetch("http://localhost:8080/LiquorAPI/liquor")
                    .then(response => response.json())
                    .then(data => {
                        for (var i = 0; i < data.length; i++){
                            //console.log(data[i]);
                            $.ajax({
                                type: "POST", //傳送方式
                                url: "getInfo.php", //傳送目的地
                                dataType: "text", //資料格式
                                data: data[i],
                                success: function(data) {
                                    $("#result").html(data);
                                    console.log(data);
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    $("#result").html(thrownError);
                                }
                            })
                        }
                    })
            }
        </script>
    </head>
    
    <body>
        <?php
            include_once 'resetLiquors.php'; // clean the tables
        ?>
        <button type="button" id="submitExample" onclick="express()">執行範例</button>
        <p id="result"></p> <!-- 顯示回傳資料 -->
    </body>
</html>