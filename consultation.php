<?php
session_start();
if(!isset($_SESSION['user_id']))
{
     header('location:index.php');
     $_SESSION['sys']=0;
}
else
{
     $user_id=$_SESSION['user_id'];
}
$con=mysqli_connect('localhost','root','','healthcare');
      if(isset($_POST['submit']))
      {     
            $name=$_POST['name'];
            $email=$_POST['email'];
            $age=$_POST['age'];
            $weight=$_POST['weight'];
            $gender=$_POST['gender'];
            $treatment=$_POST['treatment'];
            $q1=$_POST['Q1'];
            $q2=$_POST['Q2'];
            $title=$_POST['title'];
            $desc=$_POST['desc'];
        $query2 ="INSERT INTO  `consultation`(`user_id`,`guest_name`,`guest_age`,`weight`,`guest_gender`,`guest_currentcon`,`guest_gmail`,`guest_allergy`,`problem`,`title`,`description`) VALUES ('$user_id','$name','$age','$weight' ,'$gender','$q1','$email','$q2','$treatment' ,'$title','$desc')";
              $run1=mysqli_query($con,$query2);
              if($run1)
              { 
                echo '<script>alert("Submitted Successfully")</script>';
              }
              else
                echo '<script>alert("Error while submitting")</script>';
      }
      ?>
<!--DOCTYPE html-->

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


     <style type="text/css">
       
       .yellow{
        background-color: #e3eaa7;
       }
       .green{
        background-color: #bdcebe;
       }
     </style>

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
                         <li><a href="findclinic.php" style=" font-size: 1.3rem;"class="smoothScroll">Make an appointment</a></li>
                         <li><a href="findlab.php" style="font-size: 1.3rem;"class="smoothScroll">Book Lab Testing</a></li>
                         <li><a href="consultation.php"style="font-size: 1.3rem;" class="smoothScroll">Consultation</a></li>
                         <li><a href="profile.php" style="font-size: 1.3rem;"class="smoothScroll">My Profile</a></li>
                         <li><a href="index.php?logout=T" style="font-size: 1.3rem;"class="smoothScroll">Log Out</a></li> 
                   </ul>
              </div>

         </div>
    </section>

    
<!-- MAKE AN APPOINTMENT -->
<section id="appointment" data-stellar-background-ratio="3">
     <div class="container">
          <div class="row">

               <div class="col-md-4 col-sm-4">
                      <h3 style="color: #a5c422;">Pending</h3>
                      <br>
                     <?php
                      $query="SELECT * FROM `consultation`  where  `flag`=0 AND `user_id`='$user_id'";
                      $run=mysqli_query($con,$query);
                        if(mysqli_num_rows($run)>0){
                         while($row=mysqli_fetch_assoc($run))
                         { 
                          //print_r($row);
                       ?>

                         
                        <div class="wow fadeInUp" data-wow-delay="0.8s">
                             
                               <div class="card yellow bg-warning">
                                 <div class="card-body"><p style="color: black;"><b>Name : </b><?php  echo  $row['guest_name']; ?></p>

                                 <p style="color: black;"><b>Title : </b><?php echo  $row['title']; ?></p></div>

                               </div>
                               <br>
                             
                               

                             
                               

                              
                               

                        </div>



                     <?php }} ?>

                        <h3 style="color: #a5c422;">Answered Querries</h3>
                        <br>
                     <?php
                            
                      $query="SELECT * FROM `consultation`  where  `flag`=1 AND `user_id`='$user_id'";
                      $run=mysqli_query($con,$query);
                        if(mysqli_num_rows($run)>0){
                         while($row=mysqli_fetch_assoc($run))
                         { 
                          $doc=$row['doc_id'];
                          
                          $query2="SELECT * FROM `doctors` WHERE `id`='$doc'";
                          $run2=mysqli_query($con,$query2);
                          $row2=mysqli_fetch_assoc($run2);
                         //$run2= $query2->get_result();
                         //$row1=$run1->fetch_assoc();
                       ?>

                         
                        <div class="wow fadeInUp" data-wow-delay="0.8s">
                             
                               <div class="card green bg-warning text-white">
                                 <div class="card-body"><p style="color: black;"><b>Name : </b><?php  echo  $row['guest_name']; ?></p>

                                 <p style="color: black;"><b>Title : </b><?php echo  $row['title']; ?></p>
                                 <p style="color: black;"><b>Doctor : </b><?php echo  $row2['name']; ?></p>
                                 <p style="color: black;"><b>Consultation : </b><?php echo  $row['consultation']; ?></p></div>

                               </div>
                               <br>
                             
                          

                        </div>



                     <?php }} ?>

               </div>
                     
                 <div class="col-md-2 col-sm-2">

                 </div>


               <div class="col-md-6 col-sm-6">
                    <!-- CONTACT FORM HERE -->
                    <form id="appointment-form" role="form" method="post" action="#">

                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                              <h2>ASK FOR CONSULTATIONS</h2>
                         </div>

                         <div class="wow fadeInUp" data-wow-delay="0.8s">
                              <div class="col-md-6 col-sm-6">
                                   <label for="name">Name</label>
                                   <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <label for="email">Email</label>
                                   <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                              </div>

                              <div class="col-md-2 col-sm-2">
                                   <label for="age">Age</label>
                                   <input type="number" class="form-control" id="age" name="age" placeholder="Age">
                              </div>
                              
                              <div class="col-md-2 col-sm-2">
                                   <label for="weight">Weight</label>
                                   <input type="number" class="form-control" id="weight" name="weight" placeholder="Weight">
                              </div>
                              

                              <div class="col-md-4 col-sm-4">
                                   <label for="select">Gender</label>
                                   <select name="gender" class="form-control">
                                   <option selected>Select</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="O">Other</option>
                                   </select>
                                   
                              </div>
                              

                              <div class="col-md-4 col-sm-4">
                                   <label for="select">Treatment Type</label>
                                   <select name="treatment" class="form-control">
                                   <option selected>Select</option>
                                   <option value="Phychiatrist" >Phychiatrist</option>
                                    <option value="Cardiovascular Surgeon" >Cardiovascular Surgeon</option>
                                   <option value="Physician" >Physician</option>
                                   <option value="Cosmetologist" >Cosmetologist</option>
                                   </select>
                                   
                              </div>

                              



                              <div class="col-md-12 col-sm-12">
                                  
                                    <label for="name">Are you under Medication or any previously diagnosed condition?</label>
                                   <input type="text" class="form-control"  name="Q1" placeholder="Description">

                                   <label for="name">Do you have any Allergy?</label>
                                   <input type="text" class="form-control"  name="Q2" placeholder="Description">


                                   <label for="name">Title</label>
                                   <input type="text" class="form-control"  name="title" placeholder="Max 40 chars">
                              
                                   <label for="Message">Description</label>
                                   <textarea class="form-control" rows="5" id="desc" name="desc" placeholder="Description (100-1000 chars)"></textarea>
                                   <button type="submit" class="form-control" id="cf-submit" name="submit">Submit</button>
                              </div>
                         </div>
                   </form>
               </div>

          </div>
     </div>
</section>

<br>
<br>
<br>
<br>
<br>




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