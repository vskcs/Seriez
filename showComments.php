<?php 
    include('navBar.php');
    include_once('config.php');
    $getComments = "select * from comments";
    $result = $conn->query($getComments);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <style>
         .center{
        width: 50%;
        margin:auto;
        margin-top: 2%;
        margin-bottom: 2%;
        text-align: center;
    }
    .comms{
        text-align: left;
    }
    </style>
</head>
<body>
    <div class="center">
        <div class="comms">
        <table class="table table-bordered table-hover">
    <thead class="thead-dark">
                    <tr>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                </thead>
    <?php while($row = $result->fetch_assoc()){?>
        <tr class="table <?php echo $row['comment_id']%2==0 ? "table-light": "table-success"?>">
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['message'];?></td>
        </tr>
    <?php }?>
    </table>
        </div>
    </div>
    
</body>
</html>