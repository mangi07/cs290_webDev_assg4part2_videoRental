function makeRequest(callbackAction, x, phpScript) {
	/* code adapted from lecture "ajax.mp4" */
	var req = new XMLHttpRequest();
	if(!req){
		throw 'Unable to create HttpRequest.';
	}
	
	var url = phpScript;
	var params = "x=" + x;
	req.onreadystatechange = function(){
		if(this.readyState === 4){
			callbackAction(x);
		}
	};
	req.open('POST', url, true);
	
	/* The following borrowed and modified from	http://www.openjs.com/articles/ajax_xmlhttp_using_post.php */
	//Send the proper header information along with the request
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	req.send(params);
	

}

function toggleRental (id) {
	var video = document.getElementById(id);
	//"available" or "checked in"
	var rentalStatus = video.getElementsByTagName("td")[3].innerText;
	if (rentalStatus == "available")
		rentalStatus = "checked out";
	else
		rentalStatus = "available";
	video.getElementsByTagName("td")[3].innerText = rentalStatus;
}

