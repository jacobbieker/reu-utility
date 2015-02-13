window.onload=function(){
	document.getElementById("btn").onclick = validate;
}

function validate() {
	var valid = true;
	var form = document.getElementById('app');
	var msg = "The following fields must be filled out or changed before continuing:\n"
	with (form) {
		if (NameFirst.value == ""){
 	  		valid = false;
 	  		msg += "First Name\n";
		}
		
		if (NameLast.value == ""){
 	  		valid = false;
 	  		msg += "Last Name\n";
		}
		
		if (College.value == ""){
 	  		valid = false;
 	  		msg += "Your College or University\n";
		}

		var validEmail = email.value.indexOf("@", 0);
		if (validEmail < 1) {
    		valid = false;
    		msg += "Email Address (must be valid)\n";
		}
		
		var Fac2Email = document.getElementById('Faculty2 email').value;
		var Fac1Email = document.getElementById('Faculty1 email').value;
		if (document.getElementById('notifyLetters').checked && (Fac1Email.substr(Fac1Email.length - 3) != "edu" || Fac2Email.substr(Fac2Email.length - 3) != "edu")) {
			valid = false;
    		msg = "We only send Letter of Recommendation request emails to faculty members with a .edu email account. If your recommender does not have a .edu account or would prefer to use a different account, letters can not be accepted through online submission. In this case, to submit your application, please deselect the checkbox.";
   		 }
		
		
		if(valid) {
			block.value = 4*3;
			submit();
		} else {
			alert(msg);
		}
	}
	
}
