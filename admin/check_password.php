<?php
session_start();
   include '../config/config.php';
   
   $user = $_SESSION['user'];
    
    $handle = new config();

if(!empty($_POST["old_psw"])){
    
	$old_psw= $_POST["old_psw"];
        
        $sql = $handle->query("SELECT password FROM login WHERE username = '$user' ");
        
        $view = mysqli_fetch_array($sql);
        
        $password = $view['password'];
        
            
if($old_psw != $password )
        {
        echo '<span class="text-danger" > Incorrect password .</span>';
       
        echo "<script>$('#submit').prop('disabled',true);</script>";
        } else{
        
        echo "<script>$('#submit').prop('disabled',false);</script>";
        }

}else{
    echo '<span class="text-danger">field cannot be empty.</span>';
    
    echo "<script>$('#submit').prop('disabled',true);</script>";
}

?>
