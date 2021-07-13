<?php
session_start();
$con=mysqli_connect('localhost','root','','healthcare');
if(isset($_GET['id']))
{
    $id = $_GET['id'];
$query=$con->prepare("SELECT * FROM `labtest` WHERE `id`='$id'");
$query->execute();
 $run= $query->get_result();
 $row=$run->fetch_assoc();
}
if(isset($_POST['submit']))
{
     $user_id=$_SESSION['user_id'];
    $name=$_POST['name'];
    $age=$_POST['age'];
    $date=$_POST['date'];
    $email=$_POST['email'];
    $test=$_POST['test'];
    $phn_no=$_POST['phone'];
    $message=$_POST['message'];
    $query1=$con->prepare("INSERT INTO `labbook`(`user_id`,`lab_id`, `name`, `age`, `date`, `test`, `ph_no`, `email`, `message`) VALUES (?,?,?,?,?,?,?,?,?)");
    $query1->bind_param("sssssssss",$user_id,$id, $name,$age,$date,$test,$phn_no,$email,$message);
    if($query1->execute())
    {
        echo '<script>alert("Labtest Booked Sucessfully")</script>';
    }
    else
    {
        echo '<script>alert("Error in making appointment")</script>';
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
                    <li><a href="index.php" style="font-size: 1.3rem;"class="smoothScroll">Home</a></li>
                         <li><a href="findclinic.php" style="font-size: 1.3rem;"class="smoothScroll">Make an appointment</a></li>
                         <li><a href="findlab.php" style="font-size: 1.3rem;" class="smoothScroll">Book Lab Testing</a></li>
                         <li><a href="consultation.php" style="font-size: 1.3rem;"class="smoothScroll">Consultation</a></li>
                         <li><a href="profile.php" style="font-size: 1.3rem;"class="smoothScroll">My Profile</a></li>
                         <li><a href="index.php?logout=T" style="font-size: 1.3rem;" class="smoothScroll">Log Out</a></li> 
                         
                    </ul>
               </div>

         </div>
    </section>


    


<!-- MAKE AN APPOINTMENT -->
<section id="appointment" data-stellar-background-ratio="3">
     <div class="container">
     
     <div class="row">
     <div class="col-md-2 col-sm-2"></div>
<div class="col-md-2 col-sm-2" >
<h1><i class="fa fa-medkit"></i></h1>
</div>
<div class="col-md-5 col-sm-5" style="background-color: #f0f0f0;">
    <h3><?php echo $row['name']; ?></h3>
    <h5><b><?php echo $row['ph_no']; ?></b></h5>
    <h5><?php echo $row['mail']; ?></h5>
    <h5><?php echo $row['city']; ?></h5>
    
</div>
<div class="col-md-3 col-sm-3"></div>
</div>

<div class="col-md-12 col-sm-12 border-top">
          <div class="row">

               <div class="col-md-6 col-sm-6">
               <br>
                    <br>
                    <br>
                    <img src="images/appointment-image1.jpg" class="img-responsive" alt="">
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- CONTACT FORM HERE -->
                    <form id="appointment-form" role="form" method="post" action="#">

                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                              <h2>Lab Booking</h2>
                         </div>

                         <div class="wow fadeInUp" data-wow-delay="0.8s">
                              <div class="col-md-6 col-sm-6">
                                   <label for="name">Name</label>
                                   <input type="text" class="form-control" id="name"  name="name" placeholder="Full Name">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <label for="age">Age</label>
                                   <input type="text" class="form-control" id="age" name="age" placeholder="Your Age">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   
                                   <label for="date">Date of Appointment</label>
                                   <select id="date" name="date" class="form-control" onclick="select()" onchange="" >
                                        <option selected>Select</option>
                                        <option id = "0"></option>
                                        <option id = "1"></option>
                                        <option id = "2"></option>
                                        <option id = "3"></option>
                                        <option id = "4"></option>
                                        <option id = "5"></option>
                                        <option id = "6"></option>
                                   </select>
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <label for="select">Test</label>
                                   <select id="test" class="form-control" name="test" >
                                        <option selected>Select</option>
                                        <option id="test1">test1</option>
                                        <option id="test2">test2</option>
                                        <option id="test3">test3</option>
                                        <option id="test4">test4</option>
                                   </select>
                              </div>
                              <div id="demo"></div>
                              <div class="col-md-12 col-sm-12">
                                   <label for="telephone">Phone Number</label>
                                   <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone">
                                   <label for="email">Email</label>
                                   <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                   <label for="Message">Additional Message</label>
                                   <textarea class="form-control" rows="5" id="message" name="message" placeholder="Message"></textarea>
                                   <div id="dem">
                                   <button type="submit" class="form-control" id="cf-submit" name="submit" value="submit">Confirm</button>
                                   </div>
                              </div>
                         </div>
                   </form>
               </div>

          </div>
     </div>
</div>
</section>
<br>
<br>
<div class="section-title wow fadeInUp" data-wow-delay="0.4s">
     <h3>Address Map</h3>
</div>
<section id="google-map"> 
     <!-- How to change your own map point
            1. Go to Google Maps
            2. Click on your location point
            3. Click "Share" and choose "Embed map" tab
            4. Copy only URL and paste it within the src="" field below
	-->
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3647.3030413476204!2d100.5641230193719!3d13.757206847615207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf51ce6427b7918fc!2sG+Tower!5e0!3m2!1sen!2sth!4v1510722015945" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
     </section> 

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


   <script>
function select()
{
var ourDate = new Date();
                    //Change it so that it is 7 days in the past.
                    var i=0;
                    var dates = [];
                    while(i<7)
                    {
                    var pastDate = ourDate.getDate() + 1;
                    ourDate.setDate(pastDate);
                    var str = ourDate.toString();
                    var s = str.substring(0,15);
                    //console.log(s);
                    dates.push(s);   
                    document.getElementById(i).innerHTML = dates[i];          
                    i++;
                    }
                    console.log(dates);
                    
}
     
function slot()
{
    var date = document.getElementById("date").value;
    console.log(date);
    
    if(date!="Select")
    {
        <?php
    $query=$con->prepare("SELECT * FROM `labbook`");
    $query->execute();
    $run= $query->get_result();
    $row=$run->num_rows;
    ?>
    var id = "<?php echo $row; ?>"
    var a=0;
    show(a);
    <?php
    while($res=$run->fetch_assoc())
    {
     ?>
     var dat = "<?php echo $res['date']; ?>";
     var com = date.localeCompare(dat);
     if(com==0)
     {
          a=1;
          show(a);
     }
     id++;
     <?php
          //echo 'show(1);';
    }
    ?>
    }
    else{
         a=2;
         show(a);
    }
}
function show(a)
{
     if(a==1)
     {
     //console.log(a);
     let tab=`<p style="color: red;">Unavailable</p>`;
     document.getElementById("demo").innerHTML = tab; 
     let ta = ``;
     document.getElementById("dem").innerHTML = ta; 
     }
     else if(a==2)
     {
          let tab=``;
          document.getElementById("demo").innerHTML = tab; 
          let ta=`<button type="submit" class="form-control" id="cf-submit" name="submit" value="submit">Confirm</button>`;
          document.getElementById("dem").innerHTML = ta;
     }
     else
     {
          let tab=`<p style="color: green;">Available</p>`;
          document.getElementById("demo").innerHTML = tab;
          let ta = `<button type="submit" class="form-control" id="cf-submit" name="submit" value="submit">Confirm</button>`;
          document.getElementById("dem").innerHTML = ta;
     }
}

     </script>
    
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
