<?php 
session_start();
if(isset($_SESSION['role'])){
  $role = $_SESSION['role'];
}else{
  $role="";
}
?>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
    integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"
  ></script>
 
<style>
  body {
    background-image: url("images/newbg.jpg");
    background-size: cover;
}
.card {
  background-color: #ababab;
  border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
			0 10px 10px rgba(0,0,0,0.22);
  opacity: 0.9;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <a class="navbar-brand" href="#">S E R I E Z</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="./welcome.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a>
        </li>
        <?php if($role != ""){?>
            <li class="nav-item">
              <a class="nav-link" href="./showWebSeries.php"><i class="fa fa-play"></i>&nbsp;Webseries</a>
            </li>
            <?php if($role == "admin"){?>
              <li class="nav-item">
              <a class="nav-link" href="./addWebSeries.php"><i class="fa fa-video"></i>&nbsp;Add new</a>
            </li>
            <?php } ?>
          <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="./about.php"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./contact.php"> <span><i class="fas fa-envelope-open-text"></i></span>&nbsp;Contact Us</a>
        </li>
          
      </ul>
      <ul class="navbar-nav navbar-right">
          <?php if($role==""){?>
          <li class="nav-item">
            <a class="nav-link" href="./multi_user_login.php"><i class="fa fa-sign-in-alt" aria-hidden="true"></i>&nbsp;Login</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="./register.php"> <span><i class="fas fa-user-plus"></i></span>&nbsp;Register</a>
          </li>

          <?php }else{?>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="return logOut();"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
            </li>
          <?php } ?>
      </ul>
    </div>
  </nav>
  <script>
//adds the active classs whenever  the user changes webpages
    $('ul').find('li.active').removeClass('active');
    var url = window.location.pathname;
    var filename = url.substring(url.lastIndexOf('/')+1);
    $('a[href$="' + filename + '"]').addClass('active');

    function logOut(){
        //Confirm from user if he really wants to logout
        //confirm() method returns true if user clicks OK otherwise it is false
        if(confirm("Do you want to Logout")){
            window.location.href='logout.php'; 
        }
    }
  </script>