<?php 
session_start();
$con=mysqli_connect('localhost','root','','healthcare');
$doct_id=$_SESSION['doct_id'];
$query=$con->prepare("SELECT * FROM `doctors` WHERE `userdoc_id`='$doct_id'");
$query->execute();
 $run= $query->get_result();
 $res=$run->fetch_assoc();
 $_SESSION['condoc'] = $res['id'];
 $do_id=$res['id'];
 $special=$res['specialization'];
 
 
 $query1=$con->prepare("SELECT * FROM `appointment` WHERE `doc_id`='$do_id'");
$query1->execute();
 $run1= $query1->get_result();
 $row1=$run1->num_rows;

 $query2=$con->prepare("SELECT * FROM `users` WHERE `id`='$doct_id'");
 $query2->execute();
  $run2= $query2->get_result();
  $res2=$run2->fetch_assoc();
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
                         
                         <li><a href="index.php?logout=T" style="font-size: 1.3rem;" class="smoothScroll">Log Out</a></li> 
                         
                    </ul>
               </div>

         </div>
    </section>

    <section data-stellar-background-ratio="3">
<div class="container">
  <div class="row">
  <br>
  <br>
  <div class="col-md-4 col-sm-4">        
  <div id="user_image" class="text-align-center"> 
  </div>
  </div>
  <div class="col-md-8 col-sm-8">

  <h4>Name : <?php echo $res['name']; ?></h4>
  <div class="row">
  <div class="col-md-6 col-sm-6">  
  <h5><b>Specialization : </b><?php echo $res['specialization']; ?></h5>
  <h5><b>City : </b><?php echo $res['city']; ?></h5>
  </div>
  <div class="col-md-6 col-sm-6">
  <h5><b>Degree : </b><?php echo $res['degree']; ?></h5>
  <h5><b>Email : </b><?php echo $res2['email']; ?></h5>
  </div>
  </div>
  

  
  <h3 style="color: #a5c422;">Appointments</h3>
  <br>
  <div class="table-responsive" style="background-color: #f0f0f0;">
  <table class="table table-borderless">
  <thead>
    <tr>
    <th scope="col">Date</th>
    <th scope="col">Time</th>
    <th scope="col">Name</th>
    <th scope="col">Age</th>
    <th scope="col">Phone</th>
    <th scope="col">Message</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($res1=$run1->fetch_assoc())
  {
  ?>
  <tr>
      <td scope="row"><?php echo $res1['date']; ?></td>
      <td><?php echo $res1['time']; ?></td>
      <td><?php echo $res1['name']; ?></td>
      <td><?php echo $res1['age']; ?></td>
      <td><?php echo $res1['phn_no']; ?></td>
      <td><?php echo $res1['message']; ?></td>
    </tr>
    <?php
  }
    ?>
    </tbody>
</table>
</div>





<h3 style="color: #a5c422;">Consultations</h3>
  <br>
<div class="table-responsive" style="background-color: #f0f0f0;">
  <table class="table table-borderless">
  <thead>
    <tr>
    <th scope="col">Name</th>
    <th scope="col">Age</th>
    <th scope="col">Gender</th>
    <th scope="col">Current Condition</th>
    <th scope="col">Allergy</th>
    <th scope="col">Title</th>
    <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
  $query1=$con->prepare("SELECT * FROM `consultation` WHERE `problem`='$special' AND `flag`=0");
  $query1->execute();
   $run1= $query1->get_result();
   $row1=$run1->num_rows;
  while($res1=$run1->fetch_assoc())
  {
  ?>
  <tr>
      <td scope="row"><?php echo $res1['guest_name']; ?></td>
      <td><?php echo $res1['guest_age']; ?></td>
      <td><?php echo $res1['guest_gender']; ?></td>
      <td><?php echo $res1['guest_currentcon']; ?></td>
      <td><?php echo $res1['guest_allergy']; ?></td>
      <td><?php echo $res1['title']; ?></td>
      <td>
      <form action="" method="get">
    <a href="giveconsult.php?user=<?php echo $res1['id']; ?>" class="btn btn-primary">Give Consultation</a>
    </form>
      
     </td>
    </tr>
    <?php
  }
    ?>
    </tbody>
</table>
</div>


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
