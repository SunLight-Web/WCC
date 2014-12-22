<?php
include_once('../inc/dbConnect.php');
include_once('menu_items.php');
	// TODO:
	// SECURITY!!!!!!!!

	// Retrieve data from Query String
$itemID = $_GET['itemID'];

	// Escape User Input to help prevent SQL Injection
$itemID = $mysqli->real_escape_string($itemID);
	
$query = "SELECT * FROM menu WHERE id = '$itemID'";

	//Execute query
$qry_result = $mysqli->query($query);	

	$display_string = '';

	if ($qry_result->num_rows <> 0) {
		$row = mysqli_fetch_array($qry_result);
		$display_string .= $row['name'] . ' ' . $row['price'] . 'руб <br/>';

	} else {

	}
$mysqli->close();
echo $display_string;
?>