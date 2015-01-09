<?php
class item_check {
	public $id;
	public $clientid;
	public $orderlist;
	public $cash;
	public $timecode;
	public $cups = 0;

	function __construct($id, $clientid, $orderlist, $cash, $timecode) {
		$this->id 				= $id;
		$this->clientid  		= $clientid;
		$this->orderlist 		= $orderlist;
		$this->cash 			= $cash;
		$this->timecode 		= substr($timecode, 10, strlen($timecode));

		
	}
	function getcups(){

	}

	function getOrderedList(){
		$mysqli = $GLOBALS['mysqli'];
		$ordered = explode('.',$this->orderlist);
		$preparedStrings = array();
		$ban = array();
		foreach ($ordered as $value) {
			$query = "SELECT `id`,`name`,`amount`,`isCoffee` FROM `menu` WHERE `id` = " . $value;
			$stmt  = $mysqli->query($query);
			$row = $stmt->fetch_assoc();
			if (!in_array($row['id'], $ban)) {
				$string = '';
				$string .= $row['name'] . ' ';
				if ($row['isCoffee'] == 1) { $string .= $row['amount'] . 'мл'; } 
				$string .= '<br/>';
				array_push($preparedStrings, $string);
			} else {
				$string .= 'Дохуя говна<br/>';
			}
		array_push($ban, $row['id']);
		}
		return $preparedStrings;
	}

	function show() {
	$mysqli = $GLOBALS['mysqli'];
	$cleintInfo   = $mysqli->query("SELECT `card`, `name`, `lastname` FROM `clients` WHERE `id` = '$this->clientid'");
	$cleintInfo   = $cleintInfo->fetch_assoc();

	// while ($row = $stmt->fetch_assoc()) {
	// 	if ($row['isCoffee']) { 
	// 		$isLiquid = $row['amount'] . 'мл'; 
	// 		$this->cups++;
	// 	} else { 
	// 		$isLiquid = ''; 
	// 	}
	// 	$orderlistArr[$row['id']] = $row['name'] . ' ' . $isLiquid;
	// }


              echo "<tr>";
              	echo "<td>" . $cleintInfo['card'] . '<br/>' . $cleintInfo['name'] . ' ' . $cleintInfo['lastname'] .   "</td>";
              	echo "<td>";
    // foreasch for preapred array of orders goes here.
              	$preparedStrings = $this->getOrderedList();
              		foreach ($preparedStrings as $string) {
              			echo $string;
              		}
              	echo "</td>";
              	echo "<td>" . $this->cash . "₽</td>";
              	echo "<td>" . $this->timecode . "</td>";
              	echo "<td>" . "<a ondblclick='alert(\"Я пока не реализовал это дерьмо\")'>x</a>" . "</td>";
                echo "</tr>";
	}
}

$checks = array();
$query  = "SELECT `id`, `clientid`, `orderlist`, `cash`, `timecode` FROM `check` WHERE `timecode` BETWEEN '".  date('Ymd') . "' AND '" . date('Ymd',strtotime('+1 days')) . "'	";
if (!$stmt = $mysqli->query($query)) {
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
         <table id='summary-table'>
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
$total = 0;
$totalCups = 0;

    foreach ($checks as $singleCheck) {
    	$singleCheck->show();
    	$total += $singleCheck->cash;
    	$totalCups += $singleCheck->cups;
    }
?>
		</tbody>
		</table>
		</div>
		<h5>Всего говна за день:</h5>
		<div id='total'>Считаю...
			<script type="text/javascript">
				var rows = document.getElementById('summary-table').getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;
				var total = document.getElementById('total');
				total.innerHTML = '<b>' + rows + '</b> заказов,<br/>';


			</script>
			<?php echo 'Бабок: <b>' . $total . '</b>₽' . '<br/>	'; ?>
			<?php echo 'Стаканов: <b>' . $totalCups . '</b>';?>
		</div>
         </div>
       </div>