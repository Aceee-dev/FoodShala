<!DOCTYPE html>
<html lang="en">
<?php

session_start(); //temp session
error_reporting(0); // hide undefine index
include("connection/connect.php"); // connection

if(isset($_POST['submit'] )) //if submit btn is pressed
{

   

     if(empty($_POST['title']) ||  //fetching and find if its empty
        empty($_POST['email'])|| 
        empty($_POST['c_id'])||
		empty($_POST['phone']) ||  
		empty($_POST['url'])||
		empty($_POST['o_hr'])||
		empty($_POST['c_hr']) ||
		empty($_POST['o_days']) ||
		empty($_POST['address']) ||
		empty($_POST['password']) ||
		empty($_POST['cpassword']) )
		{
			$message = "All fields must be Required!";
		}
	else
	{
		//cheching username & email if already present
	$check_username= mysqli_query($db, "SELECT title FROM restaurant where title = '".$_POST['title']."' ");
	$check_email = mysqli_query($db, "SELECT email FROM restaurant where email = '".$_POST['email']."' ");
		

	
	if($_POST['password'] != $_POST['cpassword']){  //matching passwords
       	$message = "Password not match";
    }
	elseif(strlen($_POST['password']) < 6)  //cal password length
	{
		$message = "Password Must be >=6";
	}
	elseif(strlen($_POST['phone']) < 10)  //cal phone length
	{
		$message = "invalid phone number!";
	}

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
    {
       	$message = "Invalid email address please type a valid email!";
    }
	elseif(mysqli_num_rows($check_username) > 0)  //check username
     {
    	$message = 'username Already exists!';
     }
	elseif(mysqli_num_rows($check_email) > 0) //check email
     {
    	$message = 'Email Already exists!';
     }
	else{
       
     //inserting values into db
    $date = date('Y-m-d H:i:s');
    

	$mql = "INSERT INTO restaurant (c_id,title,email,phone,url,o_hr,c_hr,o_days,address,password) VALUES (".$_POST['c_id'].",'".$_POST['title']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['url']."','".$_POST['o_hr']."','".$_POST['c_hr']."','".$_POST['o_days']."','".$_POST['address']."','".md5($_POST['password'])."')";
	mysqli_query($db, $mql);
	$success = "Account Created successfully! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
														<script type='text/javascript'>
														function countdown() {
															var i = document.getElementById('counter');
															if (parseInt(i.innerHTML)<=0) {
																location.href = 'restlogin.php';
															}
															i.innerHTML = parseInt(i.innerHTML)-1;
														}
														setInterval(function(){ countdown(); },1000);
														</script>'";
		
		
		
		
		 header("refresh:5;url=restlogin.php"); // redireted once inserted success
    }
	}

}


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>FoodShala</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
     <div class="site-wrapper animation" data-animation-in="fade-in" data-animation-out="fade-out">
         <!--header starts-->
         <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
               <div class="container">
                  <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                  <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/foodshala.png" alt=""> </a>
                  <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                     <ul class="nav navbar-nav">
							<li class="nav-item"> <a class="nav-link active" href="restindex.php">Home <span class="sr-only">(current)</span></a> </li>
                           
                            
							<?php
						if(empty($_SESSION["rest_id"]))
							{
								echo '<li class="nav-item"><a href="restlogin.php" class="nav-link active">login</a> </li>
							  <li class="nav-item"><a href="restreg.php" class="nav-link active">signup</a> </li>';
							}
						else
							{
									
                                echo  '<li class="nav-item"><a href="restorders.php" class="nav-link active">View orders</a> </li>';
                                echo  '<li class="nav-item"><a href="restaddmenu.php" class="nav-link active">Add Menu</a> </li>';
                                echo  '<li class="nav-item"><a href="restlogout.php" class="nav-link active">logout</a> </li>';
									
							}

						?>
							 
                        </ul>
                  </div>
               </div>
            </nav>
            <!-- /.navbar -->
         </header>
         <div class="page-wrapper">
            <div class="breadcrumb">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">
					  <span style="color:red;"><?php echo $message; ?></span>
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					   
					</a></li>
                    
                  </ul>
               </div>
            </div>

     
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body">
                           <h2> Restaurant Registration Page </h2> 
							  <form action="" method="post">
                                 <div class="row">
								  <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">Title</label>
                                       <input class="form-control" type="text" name="title" id="example-text-input" placeholder="title"> 
                                    </div>
                                    <div class="form-group col-sm-12">
                                    <label for="exampleInputcategory">Category</label>
                                    <select name="c_id">
                                      <?php>
                                        include("connection/connect.php"); // connection

                                        $categ = mysqli_query($db,"SELECT c_name,c_id from res_category");

                                        while ($rows = mysqli_fetch_assoc($categ)) {
                                             $categ_name = $rows['c_name'];
                                             $cval= $rows['c_id'];
                                             echo "<option value='$cval'> $categ_name </option>";   
                                        }
                                     
                                      ?>
                                    </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Email address</label>
                                       <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> <small id="emailHelp" class="form-text text-muted">We"ll never share your email with anyone else.</small> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Phone number</label>
                                       <input class="form-control" type="text" name="phone" id="example-tel-input-3" placeholder="Phone"> <small class="form-text text-muted">We"ll never share your phone with anyone else.</small> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">URL</label>
                                       <input class="form-control" type="text" name="url" id="example-text-input1" placeholder="www.example.com"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Opening Hour</label>
                                       <input class="form-control" type="text" name="o_hr" id="example-text-input-2" placeholder="10.00 am"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Closing Hour</label>
                                       <input class="form-control" type="text" name="c_hr" id="example-text-input-3" placeholder="7.00 pm"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Opening Day</label>
                                       <input class="form-control" type="text" name="o_days" id="example-text-input-4" placeholder="mon-fri"> 
                                    </div>

                                    <div class="form-group col-sm-12">
                                       <label for="exampleTextarea">Address</label>
                                       <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"></textarea>
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Password</label>
                                       <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Repeat password</label>
                                       <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Password"> 
                                    </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Register" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                 </div>
                              </form>
                           
						   </div>
                           <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                     </div>
                    
                  </div>
               </div>
            </section>
           
            <!-- start: FOOTER -->
        <footer class="footer">
            <div class="container">
                <!-- top footer statrs -->
                <div class="row top-footer">
                    <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                        <a href="#"> <img src="images/foodshala.png" alt="Footer logo"> </a> <span>Order Delivery &amp; Take-Out </span> </div>
                    <div class="col-xs-12 col-sm-2 about color-gray">
                        <h5>About Us</h5>
                        <ul>
                            <li><a href="#">About us</a> </li>
                            <li><a href="#">History</a> </li>
                            <li><a href="#">Our Team</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                        <h5>How it Works</h5>
                        <ul>
                            <li><a href="#">Enter your location</a> </li>
                            <li><a href="#">Choose restaurant</a> </li>
                            <li><a href="#">Choose meal</a> </li>
                            <li><a href="#">Pay via credit card</a> </li>
                            <li><a href="#">Wait for delivery</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-2 popular-locations color-gray">
                        <h5>Popular locations</h5>
                        <ul>
                            <li><a href="#">Bangalore</a> </li>
                            <li><a href="#">Gurgaon</a> </li>
                            <li><a href="#">Patna</a> </li>
                        </ul>
                    </div>
                </div>
                <!-- top footer ends -->
                <!-- bottom footer statrs -->
                <div class="bottom-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>Payment Options</h5>
                            <ul>
                                <li>
                                    <a href="#"> <img src="images/paypal.png" alt="Paypal"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>Address</h5>
                            <p>Marker Gali,Gurgaon</p>
                            <h5>Phone: <a href="tel:070000012222">070 000012 222</a></h5> </div>
                        <div class="col-xs-12 col-sm-5 additional-info color-gray">
                            <h5>Addition information</h5>
                            <p>Have an option of a large variety of foos on your Thali from various restaurants.</p>
                        </div>
                    </div>
                </div>
                <!-- bottom footer ends -->
            </div>
        </footer>
        <!-- end:Footer -->
         </div>
         <!-- end:page wrapper -->
      </div>
      <!--/end:Site wrapper -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodshala.min.js"></script>
</body>

</html>