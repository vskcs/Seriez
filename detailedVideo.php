<?php
include('navBar.php');
include('config.php');
$id = "";
if(!isset($_GET['id'])){
    header('location: welcome.php');
}else{
    $id = $_GET['id'];
}
$sql = "SELECT * from series where series_id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($result->num_rows < 1){
    echo "No results found with that id";
}
$sql = "SELECT * from genres where webseries_id='$id'";
$result1 = $conn->query($sql);

if($result1->num_rows < 1){
    echo "No results found with that id";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Series</title>
</head>
<style>
.title{
    width: max-content;
    margin: auto;
    padding: 10px;

    /* border: 5px groove blue; */
    
}

.badge{
    font-size: 16;
    padding: .5rem .5rem;
    font-weight: 500;
    line-height: inherit;
    margin: auto 20px;
}
.genres{
    margin: 20px auto;
}
#video{
    width: 100vw;
    height: 100%;
    display: none;
}
.card{
    background-color: white;
}

.desc{
    width: 50%;
    margin: auto;
    padding: 20px;
    text-align: center;
    /* border: 2px solid magenta; */
}

.text-dark{
    font-weight: 500;
}
.rating{
    margin: auto;
    padding: 10px;
    font-size: 35;
    font-weight: 600;
    line-height: inherit;
}
.top{
    color: white;
    text-align: center;
    width: 100%;
    margin:auto;
    height: 200px;
    margin-bottom: 10px; 
    background-image: url('./images/nflines.jpg');
    background-size: cover;
   cursor: pointer;
}
.star{

    color: #ffa62b;
}
.right{

    float: right;
}
.date{
    width: max-content;
    padding: 1%;
    border-radius: 40%;
}
.round{
    /* border-radius: 40%; */
    border-left: 5px solid #bedcfa;
    border-right: 5px solid #98acf8;
    border-top: 5px solid #b088f9;
    border-bottom: 5px solid #da9ff9;
}
.ratingValue{
    display: inline-block;
}
</style>
<body>

<video id="video" src="<?php echo $row['video_location'];?>" controls></video>
<div class="row-md">
    <div class="col-md-15">
        <div class="card card-body pb-0">
            <div class="top" onclick="showVideo();">              
            <br><h1 class="text-center title"><?php echo $row['series_name'];?></h1><br>
                 <div class="genres">
            <h4 class="rating">Genres:
            <?php while($row1 = $result1->fetch_assoc()){?>
               <span class="badge <?php echo $row1['genre_id']%2==0 ? "badge-dark" :  "badge-warning"; ?>"> <?php echo $row1['genre_name'];?></span>
            <?php } ?>
            </h4>
            <h5 class="text-white mt-2"><?php echo $row['description'];?></h5>
            </div>
            </div>
            
            <div class="desc">
            <p class="round bg-warning text-dark">Rating: <?php echo $row['rating'] ?></p>
            //<p class="round bg-warning text-dark">Jonre: <?php echo $row['genre'] ?></p>
                <p class="round bg-warning text-dark">Number of seasons: <?php echo $row['seasons'] ?></p>
                <p class="round bg-warning text-dark">Total number of episodes: <?php echo $row['episodes'] ?></p>
                <p class="round bg-warning text-dark">Duration of each episode: <?php echo $row['duration'] ?> minutes</p>
                <p class="round bg-warning text-dark">Published on: <?php echo $row['publish_date'] ?></p>
            </div>
        </div>
    </div>
</div>
<script>
    function showVideo(){

        $('#video').toggle();
        $('#video').focus();
    }
</script>
</body>
</html>
