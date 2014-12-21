<script>
function addToCart(name, price) {
	var tableRef = document.getElementById('shoplist').getElementsByTagName('tbody')[0];
	var newRow   = tableRef.insertRow(tableRef.rows.length);
	var left  = newRow.insertCell(0);
	var right  = newRow.insertCell(1);

	var newText  = document.createTextNode(name);
	left.appendChild(newText);

	var priceText  = document.createTextNode(price);
	right.appendChild(priceText);

	var rubLabel   = document.createTextNode('руб');
	newRow.insertCell(2).appendChild(rubLabel);

	var summary = document.getElementById('summary');
	var priceFloat 		= parseFloat(price);
	var summaryFloat 	= parseFloat(summary.value); 
	alert(typeof priceFloat);
	alert(typeof summaryFloat);
	summary.value = priceFloat + summaryFloat;
}

function ajaxFunction(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}

	// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('ajaxDiv');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	var cardnum = document.getElementById('cardnum').value;
	var queryString = "?cardnum=" + cardnum;
	ajaxRequest.open("GET", "cardProceed.php" + queryString, true);
	ajaxRequest.send(null); 
}

</script>