<?php
session_start();
$con=mysqli_connect('localhost','root','','healthcare');
$doct_id=$_SESSION['condoc'];
if(isset($_GET['user']))
{
     $user=$_GET['user'];
}
$query=$con->prepare("SELECT * FROM `consultation` WHERE `id`='$user'");
$query->execute();
$run= $query->get_result();
$res=$run->fetch_assoc();
if(isset($_POST['submit']))
{
     $consult=$_POST['consult'];
     $flag=1;

     /* $query2 ="UPDATE `consultation` SET `flag` = '$flag', `consultation` = $consult WHERE `user_id` ='$user' ";

      $run1=mysqli_query($con,$query2);

              if($run1)
              { 
                //header('location:profile.php');
                //header('refresh:0.5; url=profile.php');
                echo '<script>alert("Submitted Successfully")</script>';
               

                
              }
              else
              echo '<script>alert("Failed Error has occured")</script>';

                    }*/

     $query=$con->prepare("UPDATE `consultation` SET `doc_id`=?,`consultation`=?,`flag`=? WHERE `id`='$user'");
     $query->bind_param("sss",$doct_id,$consult,$flag);
     $query->execute();
     $run= $query->get_result();
     if($query->execute())
    {
        echo '<script>alert("Submitted Sucessfully")</script>';
    }
    else
    {
        echo '<script>alert("Error while Submitting")</script>';
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
                    <li><a href="doctprofile.php" style="font-size: 1.3rem;" class="smoothScroll">My Profile</a></li> 
                    <li><a href="index.php?logout=T" style="font-size: 1.3rem;"class="smoothScroll">Log Out</a></li> 
                         
                    </ul>
               </div>

         </div>
    </section>

    <section data-stellar-background-ratio="3">
<div class="container">
  <div class="row">
  <br>
  <br>
  <br>
  
  <div class="col-md-2 col-sm-2"></div>
  <div class="col-md-8 col-sm-8">
  <br>
  <h3 style="color: #a5c422;">Details</h3>
  <br>
  <div class="table-responsive">
  <table class="table table-borderless ">
  
  <tbody>
    <tr>
      <th scope="row">Name:</th>
      <td><?php echo $res['guest_name']; ?></td>
     
    </tr>
    <tr>
      <th scope="row">Gmail:</th>
      <td><?php echo $res['guest_gmail']; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Age:</th>
      <td><?php echo $res['guest_age']; ?></td>
     
    </tr>
    <tr>
      <th scope="row">Weight:</th>
      <td><?php echo $res['weight']; ?></td>
     
    </tr>
    <tr>
      <th scope="row">Gender:</th>
      <td><?php echo $res['guest_gender']; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Current Condition:</th>
      <td><?php echo $res['guest_currentcon']; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Title:</th>
      <td><?php echo $res['title']; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Problem:</th>
      <td><?php echo $res['problem']; ?></td>
     
    </tr>
    <tr>
      <th scope="row">Description:</th>
      <td><?php echo $res['description']; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Allergy:</th>
      <td><?php echo $res['guest_allergy']; ?></td>
      
    </tr>
  </tbody>
</table>
</div>
<h3 style="color: #a5c422;">Consultation</h3>
<br>
<form id="appointment-form" role="form" method="post" action="#">
<textarea class="form-control" rows="6" id="consult" name="consult" placeholder="Consultation"></textarea>
<br>
<br>
<button type="submit" class="form-control" id="cf-submit" name="submit" value="submit" style="background-color: #a5c422;">Confirm</button>
</form>
  </div>
  <div class="col-md-2 col-sm-2"></div>
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
