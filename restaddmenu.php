<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>New Menu addition</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="css/menustyle.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>

  <?php
include("connection/connect.php"); //INCLUDE CONNECTION
error_reporting(0); // hide undefine index errors
session_start(); // temp sessions
if(isset($_POST['submit']))   // if button is submit
{
    if(empty($_POST['title']) ||  //fetching and find if its empty
    empty($_POST['slogan'])|| 
    empty($_POST['price']) ||  
    empty($_POST['type']))
    {
        $message = "All fields must be Required!";
    }
    else
    {
          $rs_id= $_SESSION["rest_id"];

          $mql = "INSERT INTO dishes (rs_id,title,slogan,price,type) VALUES('".$_SESSION["rest_id"]."','".$_POST['title']."','".$_POST['slogan']."','".$_POST['price']."','".$_POST['type']."')";
          
          mysqli_query($db, $mql);

          $success = "Menu added successfully!";	
		 
        }

        header("refresh:5;url=restaddmenu.php");
   }

?>


<div class="site-wrapper animation" data-animation-in="fade-in" data-animation-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="nav-link active" href="index.php"> <img class="img-rounded" src="images/foodshala.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="restindex.php">Home <span class="sr-only">(current)</span> </a> </li>
                            
                           
							<?php
						if(empty($_SESSION["rest_id"])) // if restaurant is not login
							{
								echo '<li class="nav-item"><a href="restlogin.php" class="nav-link active">login</a> </li>
							       <li class="nav-item"><a href="restreg.php" class="nav-link active">signup</a> </li>';
							}
						else
							{
									//if user is login
									
                                    echo  '<li class="nav-item"><a href="restorders.php" class="nav-link active">View orders</a> </li>';
                                    echo  '<li class="nav-item"><a href="restaddmenu.php" class="nav-link active">Add Menu</a> </li>';
									echo  '<li class="nav-item"><a href="restlogout.php" class="nav-link active">logout</a> </li>';
							}

						?>
							 
                        </ul>
						 
                    </div>
                </div>
            </nav>

<script>
  setTimeout(function(){
    document.getElementById('message').style.display = 'none';
    /* or
    var item = document.getElementById('info-message')
    item.parentNode.removeChild(item); 
  */
  }, 2000);
</script>

<div class="container" id="message">
                  <ul>
                     <li><a href="#" class="active">
					  <span style="color:red;"><?php echo $message; ?></span>
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					   
					</a></li>
                    
                  </ul>
 </div>

    <div class="testbox">
      <form action="" method="post">
        <div class="banner">
          <h1>New Menu addition</h1>
        </div>
        <div class="colums">
          <div class="item">
            <label for="fname"> Title <span>*</span></label>
            <input id="fname" type="text" name="title" required/>
          </div>
          <div class="item">
            <label for="lname"> Description<span>*</span></label>
            <input id="lname" type="text" name="slogan" required/>
          </div>
      
          <div class="item">
            <label for="price">Price<span>*</span></label>
            <input id="price" type="number" step="0.01"  name="price" required/>
          </div>
        </div>
       
        <div class="question">
          <label>Type </label>
          <div class="question-answer">
            <div>
              <input type="radio" value="veg" id="radio_4" name="type"/>
              <label for="radio_4" class="radio"><span>Veg</span></label>
            </div>
            <div>
              <input  type="radio" value="nonveg" id="radio_5" name="type"/>
              <label for="radio_5" class="radio"><span>Non-veg</span></label>
            </div>
            
          </div>
        </div>
      
        <div class="btn-block">
          <button type="submit" name="submit">Submit</button>
        </div>
      </form>
    </div>
  </body>
</html>