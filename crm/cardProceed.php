<?php
include_once('../inc/dbConnect.php');
	// TODO:
	// SECURITY!!!!!!!!

	// Retrieve data from Query String
$cardnum = $_GET['cardnum'];

	// Escape User Input to help prevent SQL Injection
$cardnum = $mysqli->real_escape_string($cardnum);
	
$query = "SELECT * FROM clients WHERE card = '$cardnum'";

	//Execute query
$qry_result = $mysqli->query($query);	

	$display_string = '';

	if ($qry_result->num_rows <> 0) {
		$row = mysqli_fetch_array($qry_result);
		if ('' == $row['name']) {
			$display_string .= " Клиент – хуйло и зовут его никак. ";
		} else {
			$display_string .= " Клиента зовут <b>$row[name]</b>. ";	
		}
		$display_string .= " Человек купил у нас <b>$row[coffees]</b> кофе. </td><br/>";
		$display_string .= " Текущее количество бонусов: <b>" .($row['coffees'] % 6) . ".</b>";

	} else {
		$display_string .= "У нас таких карт нет. Хуйня какая-то.";
	}
$mysqli->close();
echo $display_string;
?>