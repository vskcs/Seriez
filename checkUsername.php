<?php 
    include('config.php');
    if(isset($_GET['uname'])){
        $username = $_GET['uname'];
        $res = $conn->query("SELECT * from users where username='$username'");
        if($res->num_rows> 0){
            //Send that the username already exists
           echo "yes";
        }else{
            //No username exists
          echo "no";
        }
      }
?>
