window.onload=function(){
	document.getElementById("btn").onclick = validate;
}

function validate() {
	var valid = true;
	var form = document.getElementById('eval');
	var msg = "The following fields must be filled out or changed before continuing:\n"
	with (form) {
		if (InternName.value == ""){
 	  		valid = false;
 	  		msg += "Intern Name\n";
		}
		
		if(valid) {
			block.value = 4*3;
			submit();
		} else {
			alert(msg);
		}
	}
	
}
