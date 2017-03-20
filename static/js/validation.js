<script>
function validateForm() {
    var text,y;
	y='';
	var u1= document.getElementById("uname").value;
	var u2= document.getElementById("password").value;
	var u3= document.getElementById("institute").value;
	var u4= document.getElementById("email1").value;
	var u5= document.getElementById("email2").value;
	var u6= document.getElementById("email3").value;
   
    

   
    if (u1=='') {
        text = "Please enter username.";
		document.getElementById("err1").innerHTML = text;
		return false;
	}
	else{
		document.getElementById("err1").innerHTML = y;
	}
	 if (u2.length<8 || u2.length>15) {
        text = "Please enter password between length 8 to 15.";
		document.getElementById("err2").innerHTML = text;
		return false;
	}
	else{
		
		document.getElementById("err2").innerHTML = y;
	}
	
	 if (u3=='') {
        text = "Please enter Institute Name.";
		document.getElementById("err3").innerHTML = text;
		return false;
	}
	else{
		document.getElementById("err3").innerHTML = y;
	}
	 
	var atpos1 = u4.indexOf("@");
    var dotpos1 = u4.lastIndexOf(".");
    if (atpos1<1 || dotpos1<atpos1+2 || dotpos1+2>=u4.length) {
        document.getElementById("err4").innerHTML = "Please enter valid Email.";
        return false;
    }
	else{
		document.getElementById("err4").innerHTML = y;
	}	
		
		
	var atpos2 = u5.indexOf("@");
    var dotpos2 = u5.lastIndexOf(".");
    if (atpos2<1 || dotpos2<atpos2+2 || dotpos2+2>=u5.length) {
        document.getElementById("err5").innerHTML = "Please enter valid Email.";
        return false;
    }
	else{
		document.getElementById("err5").innerHTML = y;
	}
	var atpos3 = u6.indexOf("@");
    var dotpos3 = u6.lastIndexOf(".");
    if (atpos3<1 || dotpos3<atpos3+2 || dotpos3+2>=u6.length) {
        document.getElementById("err6").innerHTML = "Please enter valid Email.";
        return false;
    }
	else{
		document.getElementById("err6").innerHTML = y;
	}
	
	
}
</script>