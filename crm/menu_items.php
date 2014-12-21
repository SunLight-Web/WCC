<?php 
class menu_item {

	public $imageSource;
	public $name;
	public $price;
	public $amount;
	public $isCoffee;

	function __construct($imageSource, $name, $price, $amount, $isCoffee) {
		$this->imageSource  = $imageSource;
		$this->name 		= $name;
		$this->price 		= $price;
		$this->amount 		= $amount;
		$this->isCoffee 	= $isCoffee;
	}

	function show() {
		echo '<li onclick="addToCart(\'' . $this->name . '\',' . $this->price . ')";>';
			echo "<span>" . $this->name   . "</span>";
			echo "<br>";
			if ($this->isCoffee) $isLiquid = "мл"; else $isLiquid = "г";
			echo $this->amount . $isLiquid;
			echo "<i>"    . $this->price . " руб</i>";
		echo "</li>";
	}
}
$menu = array();

if (!$stmt = $mysqli->query('SELECT id, image, name, price, amount, isCoffee FROM menu')) {

	echo '<h2>Сорян, что-то пошло не так :С</h2>';
} else {
    while ($row = $stmt->fetch_assoc()) {
    	$anElement = new menu_item($row['image'], $row['name'], $row['price'], $row['amount'], $row['isCoffee']);
    	array_push($menu, $anElement);
    }
}
?>

