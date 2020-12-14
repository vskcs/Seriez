<?php   
session_start();//session is a way to store information (in variables) to be used across multiple pages.  
session_destroy();  
session_start();
$_SESSION['message'] = "You are successfully logged out";
$_SESSION['type'] = "success";
header('Location: welcome.php');//use for the redirection to some page  
?>  