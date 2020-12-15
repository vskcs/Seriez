<?php
        // session_start();
        //Include the Navbar
        include('navBar.php');
        if(isset($_SESSION['role'])){
            if($_SESSION['role']=='admin'){
                header('location: adminPage.php');
            }else{
                    //go to user page
                    header('location: userPage.php');
            }
        }
        //Include the connectionDB only once not on further visits to this same webpage
        include_once('config.php');
    
        $errors = [];
        $username= $password = "";
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($sql); 
            if($result->num_rows != 0){
                $row = $result->fetch_assoc();
                $role = $row['user_type'];
                $pass = $row['passwd'];
                if(password_verify($password, $pass)){
                    $_SESSION["role"] = $role;
                    $_SESSION['User'] = $row['username'];
                    $_SESSION['userId'] = $row['id'];
                    if($role=="admin"){
                        header('Location:adminPage.php');
                    }else if($role == "user"){
                        header("Location: userPage.php?id=".$row['id']);
                    }
                }else{
                   array_push($errors, "Incorrect password");
                }
            
            }else{
                array_push($errors, "Ueranme not registered");
            }
        }     
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERIEZ - Login</title>
</head>
<style>
    .container{
        margin:auto;
    }
    .form-group{
        margin-top: 30px;
    }
</style>

<body>

<div class="row-md mt-5">
  <div class="col-md-5 m-auto">
    <div class="card card-body">
   
    <h1 class="text-center mb-3"><i class="fas fa-sign-in-alt"></i>  Login</h1>
    <?php 
    foreach ($errors as $error) {
        echo "<div class='alert alert-dismissible alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <p class='mb-0'>".$error."</p>
      </div>";
      }
?>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <?php include('alerts.php'); ?>
    <div class="form-group">
        <label for="username">Username: </label>
        <input class="form-control"type="text" name="username" id="username" placeholder="Enter Username" value="<?php echo $username ?>" required>
    
    </div>
    <div class="form-group">
        <label for="password">Password: </label>
        <input class="form-control" type="password" id="password" name="password"  placeholder="Enter Password" value="<?php echo $password ?>"required>
    </div>
    <input type="submit" class="btn btn-block btn-primary" name="submit" value="Login">
    </form>
    <p>Not registered? <a href="register.php">Register here</a> </p>
    </div>
    </div>
    </div>
    
 
</body>
</html>
