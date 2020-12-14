<?php
    $errors=[];
    $success = [];
    include('navBar.php');
    include('alerts.php');
    include("config.php");
    //To display all the errors
    
    
    function upload_image(){
      
      include("config.php");
      global $errors;
      $maxsize = 20971520; // 20MB
      $name = $_FILES['image']['name'];
      $target_dir = "images/";
      $target_file = $target_dir . $_FILES["image"]["name"];

      // Select file type
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Valid file extensions
      $extensions_arr = array("jpeg","jpg","png");

      // Check extension
      if( in_array($imageFileType,$extensions_arr) ){

        // Check file size
        if(($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
          array_push($errors, "Image File too large. File must be less than 20MB.");
          return;
        }else{
          // Upload
          if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file)){
            // Insert record
            return $target_file;
            
          }
        }

      }else{
  
        array_push($errors,"Invalid image file extension");
        return;
      }
    }
    function upload_video(){
     
      include("config.php");
      global $errors;
      $maxsize = 20971520; // 20MB
      $name = $_FILES['video']['name'];
      $target_dir = "videos/";
      $target_file = $target_dir . $_FILES["video"]["name"];

      // Select file type
      $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Valid file extensions
      $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

      // Check extension
      if( in_array($videoFileType,$extensions_arr) ){

        // Check file size
        if(($_FILES['video']['size'] >= $maxsize) || ($_FILES["video"]["size"] == 0)) {
          array_push($errors, "Video File too large. File must be less than 20MB.");
          return;
        }else{
          // Upload
          if(move_uploaded_file($_FILES['video']['tmp_name'],$target_file)){
              return $target_file;
            
          }
        }

      }else{
        array_push($errors,"Invalid video file extension");
        return;
      }
    }
    $name = $genres= $desc = $seasons = $episodes = $duration = $rating = $video = $image = "";
    if(isset($_POST['submit'])){
      
      $name = $_POST['name'];
      $genres = $_POST['genre'];
      $genre_array = explode(",", $genres);
      //If the user doesnt enter commas in the text field
      if(strpos($genres, ",")===false){
        array_push($errors, "Please enter comma seperated values only");
      }
      $desc =  $_POST['desc'];
      $seasons = $_POST['seasons'];
      $episodes = $_POST['episodes'];
      $duration = $_POST['duration'];
      $rating =  $_POST['rating'];
      //If user didn't enter description
      if($desc==""){
        array_push($errors, "Please enter some description of the webseries");
      }else{
        $desc = $conn->real_escape_string($desc);
      }
      // If the user didnt select any image
      if($_FILES['image']['error'] == 4){
        array_push($errors, "Please select an image");
      }
      // If the user didnt select any video
      if($_FILES['video']['error'] == 4){
        array_push($errors, "Please select a video");
      }
      //If there are no errors then only proceed
      if(count($errors) == 0){
        $image = upload_image();
        $video = upload_video();
      }
      //Check in the Database if the same name webseries already exists
      $sql = "select series_id from series where series_name like '%$name%'";
      $result = $conn->query($sql);
      if($result->num_rows != 0){
        //Alert the user that similar webseries already exists.
       array_push($errors, "Web series with similar name ".$name." already exists");
      }
      //If there are no errors then store the values into the db
      if(count($errors)==0){
          $sql = "INSERT INTO series(series_name, description, seasons, episodes, duration, rating, video_location, image_location) VALUES('$name', '$desc','$seasons', '$episodes', '$duration', '$rating', '$video', '$image')";
          if(!$conn->query($sql)){
            echo "Error inserting values in DB".$conn->error;
          }
          $sql = "select series_id from series where series_name='$name'";
          $result = $conn->query($sql);
          if($result->num_rows){
            $row = $result->fetch_assoc();
            $id = $row['series_id'];
            foreach ($genre_array as $genre){
              $sql = "INSERT INTO genres(webseries_id, genre_name) VALUES ('$id', '$genre')";
              if(!$conn->query($sql)){
                array_push($errors,"Failed to store genres"); 
              }
            }
            
          }else{
            array_push($errors,"Unable to store the data");
          }
          $name = $genres= $desc = $seasons = $episodes = $duration = $rating = $video = $image = "";
          array_push($success,"Successfully stored webseries data");
      }
      
     } 
     ?>
<!doctype html>
<html>
  <head>
    <title>
      Add Video
    </title>
  </head>
  <body>
  
    <?php 
      foreach ($errors as $error) {
        echo "<div class='alert alert-dismissible alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <p class='mb-0'>".$error."</p>
      </div>";
      }
      foreach ($success as $succ) {
        echo "<div class='alert alert-dismissible alert-success'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <p class='mb-0'>".$succ."</p>
      </div>";
      }
    ?>
   
     
 
  <div class="row-md mt-5">
  <div class="col-md-5 m-auto">
    <div class="card card-body">
      <h1 class="text-center mb-4">
        Add New Webseries</h1>
        <!-- <div class="seriesForm"> -->
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype='multipart/form-data'>
      <div class="form-group">
            <label for="name">Name: </label>
            <input
              type="text"
              id="name"
              name="name"
              class="form-control"
              value="<?php echo $name;?>"
              placeholder="Name of the web series"
            />
          </div>
          <div class="form-group">
            <p class="text-center bg-dark text-light">Enter genres seperated by commas</p>
            <label for="genre">Genre(s): </label>
            <input
              type="text"
              id="genre"
              name="genre"
              class="form-control"
              size="50"
              value='<?php echo $genres;?>'
              placeholder="Genres"
            />
          </div>
          <div class="form-group">
            <label for="seasons">Seasons: </label>
            <input
              type="text"
              id="seasons"
              name="seasons"
              class="form-control"
              value="<?php echo $seasons;?>"
              placeholder="Enter number of seasons"
            />
          </div>
          <div class="form-group">
            <label for="desc">Description: </label>
            <textarea value="<?php echo $desc;?>"placeholder="Type some brief info about the series here"class="form-control" id="desc" name="desc" rows="6"></textarea>
        </div>
          <div class="form-group">
            <label for="episodes">Episodes: </label>
            <input
              type="text"
              id="episodes"
              name="episodes"
              class="form-control"
              value="<?php echo $episodes;?>"
              placeholder="Enter number of episodes"
            />
          </div>
          <div class="form-group">
            <label for="duration">Duration: </label>
            <input
              type="text"
              id="duration"
              name="duration"
              class="form-control"
              value="<?php echo $duration;?>"
              placeholder="Enter the duration of each episode"
            />
          </div>
          <div class="form-group">
          <label for="rating">Rating: </label>
          <input type="text" placeholder="Enter rating of the series" class="form-control" value="<?php echo $rating;?>" name="rating"  id="rating">
          <!-- <p id="ratingValue"></p> -->
          </div>
          <div class="form-group">
      <label for="video">Select Video</label>

      <input type='file' id="video" value="<?php echo $video;?>" class="form-control-file" name='video' />

    </div>
    <div class="form-group">
      <label for="image">Select Image</label>

      <input type='file' id="image" value="<?php echo $image;?>" class="form-control-file" name='image' />

        
    </div>
    <button type='submit' class="btn btn-primary btn-block" name='submit'>Submit</button>
      </form>
    </div>
    </div>
    </div> 
    </div>

  </body>

</html>