function search_image(text){
	if (text.length==0) {
		document.getElementById("result").innerHTML="";
		document.getElementById("result").style.border="0px";
		return;
	}
			
	else {
		var http_request = new XMLHttpRequest();
		
		http_request.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
			document.getElementById("result").innerHTML = this.responseText;
		  }
		};
		
		http_request.open("GET", "search&q=" + text, true);
		http_request.send();
	}
}