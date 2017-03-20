function validateForm() {
    var text,y;
	y='';
	var u1= document.getElementById("uname").value;
	var u2= document.getElementById("password").value;
	if (u1=='') {
        text = "Please enter username.";
		document.getElementById("err1").innerHTML = text;
		return false;
	}
	else{
		document.getElementById("err1").innerHTML = y;
	}
	 if (u2=='') {
        text = "Please enter password.";
		document.getElementById("err2").innerHTML = text;
		return false;
	}
	else{
		
		document.getElementById("err2").innerHTML = y;
	}
}