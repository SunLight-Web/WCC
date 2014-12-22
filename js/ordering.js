<script>
function addToCart(idOfItem) {
}

function ajaxChecknDo(){
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
	return ajaxRequest;
}

function retrieveCardData(){
	ajaxRequest = ajaxChecknDo();
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

function retrieveList(idOfItem){
	ajaxRequest = ajaxChecknDo();
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('shoplist');
			ajaxDisplay.innerHTML += ajaxRequest.responseText;
		}
	}
	var queryString = "?itemID=" + idOfItem;
	ajaxRequest.open("GET", "itemProceed.php" + queryString, true);
	ajaxRequest.send(null);
}

</script>