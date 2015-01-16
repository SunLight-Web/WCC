<?php 
include('../inc/dbConnect.php');
class menu_item {

	public $id;
	public $imageSource;
	public $name;
	public $price;
	public $amount;
	public $category;

	function __construct($id, $imageSource, $name, $price, $amount, $category) {
		$this->imageSource  = $imageSource;
		$this->name 		= $name;
		$this->price 		= $price;
		$this->amount 		= $amount;
		$this->category 	= $category;
		$this->id 			= $id;
	}

}

class category {
	public $id;
	public $name;

	function __construct($id, $name){
		$this->id = $id;
		$this->name = $name;
	}
}
// puttin on the elements from the db into an array $menu


$menu = array();
$menu['elements'] = array();
$menu['categories'] = array();

if (!$stmt = $mysqli->query('SELECT id, image, name, price, amount, category FROM menu')) {
	echo '<h2>Сорян, что-то пошло не так с менюхой :С</h2>';
} else {
    while ($row = $stmt->fetch_assoc()) {
    	$anElement = new menu_item($row['id'], $row['image'], $row['name'], $row['price'], $row['amount'], $row['category']);
    	array_push($menu['elements'], $anElement);
    }
}


if (!$stmt = $mysqli->query('SELECT id, name FROM menuCategories')) {
	echo '<h2>Сорян, что-то пошло не так с категориями :С</h2>';
} else {
    while ($row = $stmt->fetch_assoc()) {
    	$anElement = new category($row['id'],$row['name']);
    	array_push($menu['categories'], $anElement);
    }
}
echo json_encode($menu);
?>

