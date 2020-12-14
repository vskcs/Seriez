<?php include('alerts.php'); ?>
<!DOCTYPE HTML>  
<html>
<head>
<title>SERIEZ - Register</title>
<style>
.error {color: #FF0000;}

</style>
</head>
<body>  

<?php


include('navBar.php');
include('config.php');


// define variables and set to empty values
$nameErr =  $passErr1= $passErr2 = $confPass = "";
$username = $passwd1 = $passwd2 = "";
//Tests the variables
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["username"])) {
  $nameErr = "Username is required";
} else {

  $username= test_input($_POST["username"]);

}

if (empty($_POST["password1"])) {
  $passErr1 = "Password is required";
} else {
  $passwd1 = $_POST["password1"];
  $passwd1 = test_input($_POST["password1"]);
}
if (empty($_POST["password2"])) {
  $passErr2 = "Confirm Password cannot be empty";
} else {
  $passwd2 = $_POST["password2"];
  $passwd2 = test_input($_POST["password2"]);
}
if(!empty($_POST['password1']) && !empty($_POST['password2'])){
  if($_POST['password1'] != $_POST['password2']){
    $confPass = "Password and confirm password must be same";
  }
}
$user_type = $_POST['user_type'];

if(empty($nameErr) && empty($passErr1) && empty($passErr2) && empty($confPass)){

    $hashed = password_hash($passwd1, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, passwd, user_type) VALUES ('$username', '$hashed', '$user_type')";
    if($conn->query($sql)){
        $_SESSION['message'] = "You are successfully registered..You can login now!";
        $_SESSION['type'] = "success";
        header('location:multi_user_login.php');
        // echo "<script>alert('Successfully written to database')</script>";
    }else{
        $_SESSION['message'] = "Error writing values into the db";
        $_SESSION['type'] = "danger";
        header('location:register.php');
    }
    $username = $passwd1 = $passwd2 = "";
}

  
}


?>
<div class="row-md mt-5">
  <div class="col-md-6 m-auto">
    <div class="card card-body mb-3">
      <h1 class="text-center mb-3">
        <i class="fas fa-user-plus"></i> Register
      </h1><?php include('alerts.php'); ?>
      
<div class="form-group">
<p><span class="error">* required field</span></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

<div class="form-group">

  <label for="username">Username: <span class="error">* <?php echo $nameErr;?></span> </label>
  <p id="displayResult"></p>
  <input class="form-control" type="text" id="username" 
  placeholder="Enter the username" name="username" oninput="check(this.value);"value="<?php echo $username ?>" >
  
</div>

<div class="form-group">
  <label for="password1">Password: </label>
  <span class="error">* <?php echo $passErr1;?><br></span>
  <input class="form-control" type="password" id="password1" 
  placeholder="Enter the password" name="password1"
  value="<?php echo $passwd1 ?>" >
</div>
  
<div class="form-group">
  <label for="password2">Confirm Password: </label>
  <span class="error">* <?php echo $passErr2;?>&nbsp;</span>
  <span class="error"><?php echo $confPass;?><br></span>
  <input class="form-control" type="password" id="password2" 
  placeholder="Re-enter the password"name="password2"
  value="<?php echo $passwd2 ?>" >
</div>
<div class="form-check mb-3">
  <input class="form-check-input" type="radio" name="user_type" id="user" value="user" checked>
  <label class="form-check-label mr-4" for="user">
    User
  </label>
  <input class="form-check-input" type="radio" name="user_type" id="admin" value="admin">
  <label class="form-check-label" for="admin">
    Admin
  </label>
</div>
  <input type="submit" class="btn btn-block btn-info" name="submit" value="Submit"> 
  <p class="mt-2">Already registered? <a href="multi_user_login.php">Login here</a> </p> 
</form>
</div>

</div>



<script>
  function check(val){
    // console.log(val);
    if(val==""){
      document.getElementById("displayResult").innerHTML ="";
      return;
    }
      if (window.XMLHttpRequest) {
                  // code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp = new XMLHttpRequest();
      } else {
                  // code for IE6, IE5
                  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          let text = this.responseText;
          if(text == "yes"){
              $("#displayResult").html("Username already exists");
              //Add text-danger bootstrap class so that it appears in red color
              $('#displayResult').removeClass('text-success');
              $('#displayResult').addClass('text-danger');

          }else{
            //Username is available
            $("#displayResult").html("Username is available");
              //Add text-success bootstrap class so that it appears in green color
              $('#displayResult').removeClass('text-danger');
              $('#displayResult').addClass('text-success');
          }
          
      }
      };
      xmlhttp.open("GET","checkUsername.php?uname="+val,true);
      xmlhttp.send();
  }
</script>
</body>
</html>


