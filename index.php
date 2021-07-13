<?php
session_start();
$con=mysqli_connect('localhost','root','','healthcare');
if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $query=$con->prepare("SELECT * FROM `users` WHERE `email`=? AND `password`=?");
    $query->bind_param("ss",$email,$password);
$query->execute();
  $run= $query->get_result();
  $row=$run->num_rows;
  if($row>0)
  {
      $res=$run->fetch_assoc();
      $role=$res['role'];
      if($role=='User')
      {
          $_SESSION['user_id']=$res['id'];
        header('location:profile.php');
      }
      else if($role=='Doctor')
      {
          $_SESSION['doct_id']=$res['id'];
          header('location:doctprofile.php');
      }
  }
  else
  {
    echo '<script>alert("Incorrect Email and Password")</script>';
  }
}
if(isset($_SESSION['sys']))
{
     echo '<script>alert("You are not logged In")</script>';
     unset($_SESSION['sys']);
}
else
{
     
}
if(isset($_GET['logout']))
{
     session_destroy();
     header("refresh:0.1; url=index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <link rel="icon" type="image/png" sizes="16x16" href="images/icon.jpg">
     <title>Health - Medical Website Template</title>
<!--

Template 2098 Health

http://www.tooplate.com/view/2098-health

-->
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="Tooplate">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">

</head>
<div class="container">

          <div class="modal" id="mymodel">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="text-dark" style= "color:black;">Login</h3>
                  <button type="button" class="close" data-dismiss="modal">&times</button>
                </div>
                <center>
               <div class="modal-body">
                  <form action="" method="post" name="login" class="needs-validation" novalidate>
                    
                    <div class="input-group">
                    
                   
                   <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" aria-describedby="inputGroupPrepend" required>
                 
                </div>
              
                
                <div class="input-group">
                
                    <label for="user_name">Password</label>
               
                <input type="password" name="password" class="form-control" placeholder="Password" id="pwd" required>
                
            </div>
            <p>Don't have an accout? <a href="Register.php">SignIn</a></p>
            <br>
            <div class="modal-footer  justify-content-center">
            <input type="submit" name="login" class="btn btn-success" value="Login">
               </form>
           </div>
          </center>
         </div>
        </div>
        </div>
        </div>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


     <!-- HEADER -->
    


     <!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="index.html" class="navbar-brand"><i class="fa fa-h-square"></i>ealth Center</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="#top" style="font-size: 1.3rem;" class="smoothScroll">Home</a></li>
                         <li><a href="findclinic.php" style="font-size: 1.3rem;" class="smoothScroll">Make an appointment</a></li>
                         <li><a href="findlab.php" style="font-size: 1.3rem;"  class="smoothScroll">Book Lab Testing</a></li>
                         <li><a href="consultation.php" style="font-size: 1.3rem;" class="smoothScroll">Consultation</a></li>
                         <?php
                         if(isset($_SESSION['user_id']))
                         {
                              $user_id=$_SESSION['user_id'];
                              $query=$con->prepare("SELECT * FROM `users` WHERE `id`='$user_id'");
                              $query->execute();
                              $run= $query->get_result();
                              $row=$run->fetch_assoc();
                              $mail= $row['email'];
                              ?>
                              <li><a href="profile.php" style="font-size: 1.3rem;"class="smoothScroll"><?php echo $mail; ?></a></li>
                              <li><a href="index.php?logout=T" style="font-size: 1.3rem;" class="smoothScroll">Log Out</a></li> 
                              <?php
                         }
                         else
                         {
                              ?>
                              <li><a href="#" class="smoothScroll" style=" font-size: 1.3rem;" data-target="#mymodel" data-toggle="modal">LogIn/SignIn</a></li>
                              <?php
                         }
                         ?>
                         
                         <li><a href="#about" style=" font-size: 1.3rem;" class="smoothScroll">About Us</a></li>
                         
                    </ul>
               </div>

          </div>
     </section>


     <!-- HOME -->
     <section id="home" class="slider" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                         <div class="owl-carousel owl-theme">
                              <div class="item item-first">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h3>Let's make your life happier</h3>
                                             <h1>Healthy Living</h1>
                                             
                                        </div>
                                   </div>
                              </div>

                              <div class="item item-second">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h3>Aenean luctus lobortis tellus</h3>
                                             <h1>New Lifestyle</h1>
                                             
                                        </div>
                                   </div>
                              </div>

                              <div class="item item-third">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h3>Pellentesque nec libero nisi</h3>
                                             <h1>Your Health Benefits</h1>
                                             
                                        </div>
                                   </div>
                              </div>
                         </div>

               </div>
          </div>
     </section>


     <!-- ABOUT -->
     <section id="about">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <div class="about-info">
                              <h2 class="wow fadeInUp" data-wow-delay="0.6s">Welcome to Your <i class="fa fa-h-square"></i>ealth Center</h2>
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <p>Aenean luctus lobortis tellus, vel ornare enim molestie condimentum. Curabitur lacinia nisi vitae velit volutpat venenatis.</p>
                                   <p>Sed a dignissim lacus. Quisque fermentum est non orci commodo, a luctus urna mattis. Ut placerat, diam a tempus vehicula.</p>
                              </div>
                              <figure class="profile wow fadeInUp" data-wow-delay="1s">
                                   <img src="images/author-image.jpg" class="img-responsive" alt="">
                                   <figcaption>
                                        <h3>Dr. Neil Jackson</h3>
                                        <p>General Principal</p>
                                   </figcaption>
                              </figure>
                         </div>
                    </div>
                    
               </div>
          </div>
     </section>


     <!-- TEAM -->
     <section id="team" data-stellar-background-ratio="1">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <div class="about-info">
                              <h2 class="wow fadeInUp" data-wow-delay="0.1s">Our Doctors</h2>
                         </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-4 col-sm-6">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                              <img src="images/team-image1.jpg" class="img-responsive" alt="">

                                   <div class="team-info">
                                        <h3>Nate Baston</h3>
                                        <p>General Principal</p>
                                        <div class="team-contact-info">
                                             <p><i class="fa fa-phone"></i> 010-020-0120</p>
                                             <p><i class="fa fa-envelope-o"></i> <a href="#">general@company.com</a></p>
                                        </div>
                                        <ul class="social-icon">
                                             <li><a href="#" class="fa fa-linkedin-square"></a></li>
                                             <li><a href="#" class="fa fa-envelope-o"></a></li>
                                        </ul>
                                   </div>

                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.4s">
                              <img src="images/team-image2.jpg" class="img-responsive" alt="">

                                   <div class="team-info">
                                        <h3>Jason Stewart</h3>
                                        <p>Pregnancy</p>
                                        <div class="team-contact-info">
                                             <p><i class="fa fa-phone"></i> 010-070-0170</p>
                                             <p><i class="fa fa-envelope-o"></i> <a href="#">pregnancy@company.com</a></p>
                                        </div>
                                        <ul class="social-icon">
                                             <li><a href="#" class="fa fa-facebook-square"></a></li>
                                             <li><a href="#" class="fa fa-envelope-o"></a></li>
                                             <li><a href="#" class="fa fa-flickr"></a></li>
                                        </ul>
                                   </div>

                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="team-thumb wow fadeInUp" data-wow-delay="0.6s">
                              <img src="images/team-image3.jpg" class="img-responsive" alt="">

                                   <div class="team-info">
                                        <h3>Miasha Nakahara</h3>
                                        <p>Cardiology</p>
                                        <div class="team-contact-info">
                                             <p><i class="fa fa-phone"></i> 010-040-0140</p>
                                             <p><i class="fa fa-envelope-o"></i> <a href="#">cardio@company.com</a></p>
                                        </div>
                                        <ul class="social-icon">
                                             <li><a href="#" class="fa fa-twitter"></a></li>
                                             <li><a href="#" class="fa fa-envelope-o"></a></li>
                                        </ul>
                                   </div>

                         </div>
                    </div>
                    
               </div>
          </div>
     </section>


     <!-- NEWS -->
     <section id="news" data-stellar-background-ratio="2.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Services</h2>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <!-- NEWS THUMB -->
                         <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                              <a href="findclinic.php">
                                   <img src="images/news-image1.jpg" class="img-responsive" alt="">
                              </a>
                              <div class="news-info">
                                   
                                   <h3><a href="#">Make an appointment</a></h3>
                                   <p>Maecenas risus neque, placerat volutpat tempor ut, vehicula et felis.</p>
                                   <div class="author">
                                        <form method="#" action="findclinic.php">
                                        <button type="submit" id="appoint" class="form-control">Book Now</button>
                                   </form>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <!-- NEWS THUMB -->
                         <div class="news-thumb wow fadeInUp" data-wow-delay="0.6s">
                              <a href="#">
                                   <img src="images/news-image2.jpg" class="img-responsive" alt="">
                              </a>
                              <div class="news-info">
                                   
                                   <h3><a href="#">Book lab testing</a></h3>
                                   <p>Fusce vel sem finibus, rhoncus massa non, aliquam velit. Nam et est ligula.</p>
                                   <div class="author">
                                        <form method="#" action="findlab.php">
                                             <button type="submit" id="test" class="form-control">Book Now</button>
                                        </form>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <!-- NEWS THUMB -->
                         <div class="news-thumb wow fadeInUp" data-wow-delay="0.8s">
                              <a href="#">
                                   <img src="images/news-image3.jpg" class="img-responsive" alt="">
                              </a>
                              <div class="news-info">
                                   
                                   <h3><a href="#">Ask for consultation to the doctor</a></h3>
                                   <p>Vivamus non nulla semper diam cursus maximus. Pellentesque dignissim.</p>
                                   <div class="author">
                                        <form method="#" action="consultation.php">
                                             <button type="submit" id="consult" name="consult" class="form-control">Ask Now</button>
                                       </form>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>

     

        
     <!-- GOOGLE MAP -->
   <!--  <section id="google-map"> -->
     <!-- How to change your own map point
            1. Go to Google Maps
            2. Click on your location point
            3. Click "Share" and choose "Embed map" tab
            4. Copy only URL and paste it within the src="" field below
	-->
       <!--   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3647.3030413476204!2d100.5641230193719!3d13.757206847615207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf51ce6427b7918fc!2sG+Tower!5e0!3m2!1sen!2sth!4v1510722015945" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
     </section>   -->        


     <!-- FOOTER -->
     <footer data-stellar-background-ratio="5" style="background-color: #b3d294">
        <div class="container">
             <div class="row">
             <div class="col-md-12 col-sm-12 border-top">
                    <div class="col-md-4 col-sm-6">

                    </div>
                    <div class="col-md-6 col-sm-6">

                    </div>
                    <div class="col-md-2 col-sm-2 text-align-center">
                         <div class="angle-up-btn"> 
                             <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                         </div>
                    </div>   
               </div>
               <div class="col-md-4 col-sm-4"> </div>
               <div class="col-md-4 col-sm-4">
               <div class="footer-thumb"> 
                      <center><h4 class="wow fadeInUp" data-wow-delay="0.4s" style="color:black;">Health Care</h4></center>
                      <div class="col-md-3 col-sm-3"></div>
                      <div class="col-md-9 col-sm-9">
                         <div class="contact-info">
                              <p style="color:black;"><i class="fa fa-phone"></i> 010-070-0170</p>
                              <p style="color:black;"><i class="fa fa-envelope-o"></i> <a href="#" style="color:black;">info@company.com</a></p>
                         </div>
                         </div>
                    </div>    
                    </div>
                    
               <div class="col-md-4 col-sm-4">  </div>
                    <div class="footer-thumb">
             




</div>
</div>
</footer>

                     
                   
     <!--<footer data-stellar-background-ratio="5" style="background-color: rgb(64, 128, 0);">
          <div class="container"  >
               <div class="row">

                <div class="col-md-12 col-sm-12 text-align-center">
                              <div class="angle-up-btn"> 
                                  <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                              </div>
                   </div>
                <div class="col-md-4 col-sm-4" ></div>
                    <div class="col-md-4 col-sm-4"  >
                        <h2 style="color:white;" class="text-align-center"> Health Care</h2>
                        <br>
                        <span style="color:white; font-size: 1.5rem;" ><i class="fa fa-phone"></i> 010-070-0170 </span>
                        <spam style="color:white; font-size: 1.5rem;"><i class="fa fa-envelope-o"></i><a style="color:white;" href="#"> healthcenter@company.com </a></span>

                    </div>
                    <div class="col-md-4 col-sm-4" >
                      
                    </div>
      </div>
                    
               </div>
          </div>
     </footer>-->
                         
                    

     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>


</body>
</html>