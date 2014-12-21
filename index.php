<<<<<<< HEAD
<?php
include("inc/header.php");  

if (SETUP_MODE) {           
	include("inc/setup.php");		  
} else {		

	if ('in' == $logged){
		header("Location: crm/");
	} else {
	 	include("inc/login.php");	  
	}
}  						  
	include("inc/footer.php");  
?>
 
=======
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Way Cup Coffee</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
  <body>
   <div class="main"></div>
  </body>
</html>
>>>>>>> FETCH_HEAD
