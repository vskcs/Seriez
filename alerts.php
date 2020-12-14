
<?php 
//Bootsrap alerts for showing respective messages
if(isset($_SESSION['message'])){
  if(!isset($_SESSION['type'])){
    $_SESSION['type'] = 'success';
  }
    echo "<div class='text-center alert alert-dismissible alert-".$_SESSION['type']."'>
    <button type='button' class='close' data-dismiss='alert'>&times;</button>
    <p class='mb-0'>".$_SESSION['message']."</p>
  </div>";
  unset($_SESSION['message']);
  unset($_SESSION['type']);
}
?>