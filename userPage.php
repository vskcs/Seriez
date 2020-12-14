<?php
// session_start();
include('navBar.php');
include('alerts.php');
include('config.php');
    //If the logged in user is not a normal user then take him to user that is if a admin/other tries to access this
// User page from admin/from other page then it won't be permittted.
if(isset($_SESSION['role'])){
    // echo $_SESSION['role'];
    //If the user is trying to access other users pages then it wont be permitted
    if(($_SESSION['role'] != 'user') || (isset($_GET['id']) && $_SESSION['userId'] != $_GET['id'])){
        header('location: multi_user_login.php?id='.$_GET['id']);
    }
}else{
    //If the any of the users is not at all logged in then make him redirect to login page.
    $_SESSION['message']="Please signin to view that resource";
    $_SESSION['type'] = "danger";
    header('Location: multi_user_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <style>
         .container{
        text-align: center;
        width: max-content;
        margin-top: 40vh;
        border: 2px solid blue;
        padding: 50px;
    }
    </style>
</head>
<body>


   <div class="text-center">
   <div class="jumbotron">
    <h1 class="display-3">Welcome <?php echo $_SESSION['User']?></h1>
    <p class="lead">View various webseries data available in our database</p>
    <hr class="my-2">
    <p class="lead">
        To view the available webseries<a class="btn btn-primary btn-lg ml-2" href="./showWebSeries.php" role="button">Click Here</a>
    </p>
</div>
   </div>


    
    
    
   <script>
       function onClick(){
           //Confirm from user if he really wants to logout
            //confirm() method returns true if user clicks OK otherwise it is false
           if(confirm("Do you want to Logout")){
                window.location.href='logout.php'; 
           }
       }
   </script>
</body>
</html>