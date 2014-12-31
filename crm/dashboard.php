<?php
class item_check {
	public $id;
	public $clientid;
	public $orderlist;
	public $cash;
	public $timecode;

	function __construct($id, $clientid, $orderlist, $cash, $timecode) {
		$this->id 				= $id;
		$this->clientid  		= $clientid;
		$this->orderlist 		= $orderlist;
		$this->cash 			= $cash;
		$this->timecode 		= substr($timecode, 10, strlen($timecode));

		
	}


	function show() {
		// WTF IS THIS SHIT?
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	$mysqli->set_charset("utf8");
	$stmt = $mysqli->query("SELECT `id`,`name`,`amount`,`isCoffee` FROM `menu`");
	$orderlistArr = array();
	$orderlistStr = '';
	$cleintInfo   = $mysqli->query("SELECT `card`, `name`, `lastname` FROM `clients` WHERE `id` = '$this->clientid'");
	$cleintInfo   = $cleintInfo->fetch_assoc();
	while ($row = $stmt->fetch_assoc()) {
		if ($row['isCoffee']) { $isLiquid = $row['amount'] . 'мл'; } else { $isLiquid = ''; }
		$orderlistArr[$row['id']] = $row['name'] . ' ' . $isLiquid ;
	}

	$ordered = explode('.',$this->orderlist);

	foreach ($ordered as $value) {
		$orderlistStr .= $orderlistArr[$value] . "<br/>";
	}



              echo "<tr>";
              	echo "<td>" . $cleintInfo['card'] . '<br/>' . $cleintInfo['name'] . ' ' . $cleintInfo['lastname'] .   "</td>";
              	echo "<td>"  . $orderlistStr .  "</td>";
              	echo "<td>" . $this->cash . "₽</td>";
              	echo "<td>" . $this->timecode . "</td>";
              	echo "<td>" . "<a ondblclick='alert(\"Я пока не реализовал это дерьмо\")'>x</a>" . "</td>";
                echo "</tr>";
	}
}

$checks = array();

if (!$stmt = $mysqli->query("SELECT `id`, `clientid`, `orderlist`, `cash`, `timecode` FROM `check`")) {
echo '<h2>Сорян, что-то пошло не так :С</h2>';
die();
} else {
    while ($row = $stmt->fetch_assoc()) {
    	$anElement = new item_check($row['id'], $row['clientid'], $row['orderlist'], $row['cash'], $row['timecode']);
    	array_push($checks, $anElement);
    }

}
?>

       <div class="span10">
         <div class="main-content">
         <h3>Заказы:</h3>
         <div class="table-client">
         <table>
         <thead>
         	<tr>
         		<td>
         			Клиент
         		</td>
         		<td>
         			Заказы
         		</td>
         		<td>
         			Бабло
         		</td>
         		<td>
         			Таймкод
         		</td>
         		<td>
         			Х
         		</td>
         	</tr>
         </thead>
         <tbody>
<?php
    foreach ($checks as $singleCheck) {
    	$singleCheck->show();
    }
?>
		</tbody>
		</table>
		</div>
         </div>
       </div>