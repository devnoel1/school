<?php
    $sec;
    $sub_id = $_GET['sub_id'];
    if($sec == "secondary" ){
          include "ass.php";
            
    }else if($sec == "primary"){
        echo "primary assessment";
        
        echo '<br/>'. $sub_id;
    }


?>
