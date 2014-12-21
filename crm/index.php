<?php 
if (isset($_GET['page']))
$pageID = $_GET['page'];
else
$pageID = 0;
 ?>

<?php include('pageManager.php'); ?>
<?php $pagetitle = $navElements[$pageID]->name;	 ?>
<?php include('header.php'); 	 ?>


<?php 
if (file_exists($navElements[$pageID]->href)){
	include('navigation.php'); 
	include($navElements[$pageID]->href);
} else {
	include('404.php');
}

 ?>


<?php include('footer.php'); 	 ?>