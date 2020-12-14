<?php
 include("navBar.php");
 include('config.php');
    if(isset($_POST['send'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        //store in database
        $insertCommand = "INSERT INTO comments(name, email, message) VALUES('$name', '$email', '$message')";
        
        if($conn->query($insertCommand)){
         
            echo "<script>alert('Comment sent successfully')</script>";
        }else{
            echo "Error uploading comments into the db".$conn->error;
        }
    }
?>
<div class="row-md mt-5">
  <div class="col-md-6 m-auto">
    <div class="card card-body mb-3">
    <title>SERIEZ - Contact us</title>
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4"> Contact us </h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>


            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

          
                    <div class="form-group">
                        <label for="name" class="">Your name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name"required>
                            
                        
                    </div>
          
                    <div class="form-group">
                    <label for="email" class="">Your email</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email address"required>
                            
                       
                    </div>
         
                <div class="form-group">

                             <label for="message">Your message</label>
                            <textarea type="text" id="message" name="message" rows="4" class="form-control" placeholder="Please enter your message here" required></textarea>
                            
                  
                </div>
                <input class="btn btn-block btn-primary" type="submit" name="send" value="Send"/>

            </form>

          
        </div>
</div>
</div> 
<!-- <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0" >
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>Hyderabad,India - 500046 </p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>+91 9866713040</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p>vskg2000@gmail.com</p>
                </li>
            </ul>
        </div> -->
    </div>

