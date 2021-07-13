
<?php
session_start();
$con=mysqli_connect('localhost','root','','healthcare');
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $date=$_POST['date'];
    $group=$_POST['group'];
    $phn_no=$_POST['phone'];
    $gender=$_POST['gender'];
    $address=$_POST['address'];
    $past_medi=$_POST['past_medi'];
    $query1=$con->prepare("INSERT INTO `users`(`Name`, `email`, `password`, `gender`, `dob`, `bloodgrp`, `address`, `past_medication`) VALUES (?,?,?,?,?,?,?,?)");
    $query1->bind_param("ssssssss",$name,$email,$password,$gender,$date,$group,$address,$past_medi);
    if($query1->execute())
    {
     $query=$con->prepare("SELECT * FROM `users` WHERE `email`=? AND `password`=?");
     $query->bind_param("ss",$email,$password);
     $query->execute();
     $run= $query->get_result();
     $res=$run->fetch_assoc();
     $_SESSION['user_id']=$res['id'];
     header('location:profile.php');
        echo '<script>alert("Registration Sucessfully")</script>';
    }
    else
    {
        echo '<script>alert("Error while Registration")</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
     <link rel="icon" type="image/png" sizes="16x16" href="images/icon.jpg">
     <title>Health - Medical Website Template</title>
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
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- PRE LOADER -->
    <section class="preloader">
         <div class="spinner">

              <span class="spinner-rotate"></span>
              
         </div>
    </section>


    


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
                         <li><a href="index.php" style="font-size: 1.3rem;" class="smoothScroll">Home</a></li>
                         
                         <li><a href="#about" style="font-size: 1.3rem;" class="smoothScroll">About Us</a></li>
                         
                    </ul>
               </div>

         </div>
    </section>

<!-- MAKE AN APPOINTMENT -->
<section id="appointment" data-stellar-background-ratio="3">
     <div class="container">
          <div class="row">
            <div class="col-md-1 col-sm-1"></div>
               <div class="col-md-5 col-sm-5">
                    <img src="images/register.jpg" class="img-responsive" alt="">
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- CONTACT FORM HERE -->
                    <form id="appointment-form" role="form" method="post" action="#">

                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                              <h2>Sign In</h2>
                         </div>

                         <div class="wow fadeInUp" data-wow-delay="0.8s">
                              <div class="col-md-12 col-sm-12">
                                   <label for="name">Name</label>
                                   <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <label for="email">Email</label>
                                   <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <label for="password">Password</label>
                                   <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <label for="date">Date of birth</label>
                                   <input type="date" name="date" value="" class="form-control">
                              </div>

                              <div class="col-md-6 col-sm-6">
                              <label for="group">Blood Group</label>
                                   <input type="text" class="form-control" id="group" name="group" placeholder="Blood Group">
                              </div>

                              <div class="col-md-6 col-sm-6">
                              <label for="select">Gender</label>
                                   <select id="gender" class="form-control" name="gender">
                                        <option selected>Select</option>
                                        <option id="Male">Male</option>
                                        <option id="Female">Female</option>
                                        <option id="Others">Others</option>
                                        
                                   </select>
                                </div>


                                <div class="col-md-6 col-sm-6">
                              <label for="telephone">Phone Number</label>
                                   <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone">
                              </div>

                              <div class="col-md-12 col-sm-12">
                                  
                                   <label for="Address">Address</label>
                                   <input class="form-control" rows="5" id="address" name="address" placeholder="Address">

                                   <label for="Past Medications">Past Medications</label>
                                   <textarea class="form-control" rows="5" id="past_medi" name="past_medi" placeholder="Your Past Medications"></textarea>
                                   <button type="submit" class="form-control" id="cf-submit" name="submit">Sign In</button>
                              </div>
                         </div>
                   </form>
               </div>

          </div>
     </div>
</section>
<br>
<br>

<footer data-stellar-background-ratio="5" >
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
                                </div>
                         </div>
                    </div>    
                    </div>
                    
               <div class="col-md-4 col-sm-4">  </div>
                    <div class="footer-thumb">

</div>
</div>
</footer>

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