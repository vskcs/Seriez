<?php
include('alerts.php');
include('navBar.php');
include("config.php");
$error = "";
$fetchVideos1 =  $conn->query("SELECT count(*) as 'count' FROM series ORDER BY series_id");
$total_videos = $fetchVideos1->fetch_assoc()['count'];
$fetchVideos =  $conn->query("SELECT * FROM series ORDER BY rating DESC");

if(isset($_POST['search'])){
  $name = $_POST['searchItem'];
  $fetchVideos = $conn->query("SELECT * FROM series where series_name LIKE '%$name%'");
  if($fetchVideos->num_rows==0){
    $error = "No series found with that name";
  }
}

?>
<!doctype html>
<html>
  <head>
  <title>Search</title>
    <style>
    .grid-2 {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      grid-gap: 1rem;
    }
    .search{

        display: grid;
        grid-template-columns: repeat(2, 1fr);
        width: 50%;
        /* text-align: center; */
        margin: 20px auto;
       }
       .searchBtn{
        width: 50%;
        margin: auto;
        margin-left: 2%;
        border: none;
        cursor: pointer;
       }
       .error{
          margin-top: 10%;
          color: red;
          font-size: 70;
          font-weight: 500;
       }
       body{
        background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('images/newbg.jpg');
        background-size: cover;
        
       }
    </style>
  </head>
  <body>
  <h4 class="text-center text-success float-right mr-3 mt-4 bg-dark rounded">&nbsp Total Webseries available in the DB : <?php echo $total_videos; ?>  &nbsp</h4>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
  <div class="search">
    <input class="form-control" type="search" name="searchItem" placeholder="Search" required>
    <button class="btn btn-primary searchBtn" name="search" type="submit">Search</button>
    </div>
  </form>
 
<?php if($error != ""){?>
<h2 class="error text-center"><?php echo $error;?></h2>
<?php }?>
<div class="grid-2">
<?php
     while($row = $fetchVideos->fetch_assoc()){
       ?>
      
      <div class="m-auto">
      <div class="card mb-3" style="width: 25rem;">
      <img class="card-img-top"style="height: 15rem;"src="<?php echo $row['image_location'];?>" alt="<?php echo $row['series_name'];?>">
      <div class="card-body">
      <h5 class="card-title"><?php echo $row['series_name'];?></h5>
      <p class="card-text"><?php echo $row['description'];?></p>
      <a href='<?php echo "detailedVideo.php?id=".$row['series_id'] ?>' class="btn btn-primary">More</a>
    
      
</div>
</div>
      </div>
    
<?php } ?>
    
  

 </div>


 
  </body>
</html>