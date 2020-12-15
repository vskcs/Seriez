<?php
// session_start();

include('alerts.php');
include('navBar.php');
//If the logged in user is not a admin then take him to user that is if a user tries to access this
// admin page from user/from other page then it won't be permittted.
    if(isset($_SESSION['role'])){
        if($_SESSION['role'] != 'admin'){
            header('Location: userPage.php');
        }
    }else{
        //If the role is not set that means the user/admin is not yet logged in so redirect him to the main login page
        //Set alert that the user must login
        $_SESSION['message'] = "Please login as an admin to view that page";
        $_SESSION['type'] = "danger";
        header('Location: multi_user_login.php');   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>

</head>
<style>
    .container{
        text-align: center;
        width: max-content;
        margin-top: 40vh;
        border: 2px solid blue;
        padding: 50px;
    }
</style>
<body>
<div class="text-center">
    <div style="background-color: white !important; opacity:0.9" class="jumbotron">
    <h1 class="display-3">Welcome to Admin Page</h1>
    <p class="lead">Add/View various webseries data available in our database</p>
    <hr class="my-2">

    <a class="btn btn-success btn-lg ml-2 mt-2" href="./addWebSeries.php" role="button">Add Webseries</a>
    <a class="btn btn-info btn-lg ml-2 mt-2" href="./showWebSeries.php" role="button">View Webseries</a>
    <a class="btn btn-info btn-lg ml-2 mt-2" href="./showComments.php" role="button">Show Comments</a>
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
