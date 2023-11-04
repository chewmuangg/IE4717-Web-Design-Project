var validEmail, validName, validNum;

function formChecker(){
	
	var email = document.getElementById("email").value;
	var name = document.getElementById("name").value;
	var message = document.getElementById("message").value;
	
	if((name.length>0 && validName == 0) && (email.length >0 && validEmail == 0) && (message.length <= 300)){
		return true;
	}
	else if (name.length < 3){
		alert("Name must have at least 3 characters.");		
		return false;
	} 
	else if (!(name.length > 0 && validName == 0)){
		alert("Name can only contain alphabets and spaces.")
		return false;
	} 
	else if (validEmail != 0){
		alert("Invalid email.");
		return false;
	} 
	else if(message.length > 300){
		alert("Cannot exceed 300 word characters.");
		return false;
	}
	
}





function emailChecker(){

	var email = document.getElementById("email").value;
	var text;


	validEmail = email.search(/^[\w-\.]+@([\w]+\.){1,3}[a-zA-Z]{1,3}$/);


	if (validEmail != 0){
	text = "Invalid email.";
	} else {
	text = "";
	}


	if (email.length >0) {
	document.getElementById("email-error").innerHTML = text;
	} else {
	document.getElementById("email-error").innerHTML = "";
	}

}

function nameChecker(){

	var name = document.getElementById("name").value;
	var text;


	validName = name.search(/^[A-Za-z\s]{3,}$/);


	if (validName != 0){
	text = "Name cannot contain a number.";
	} else {
	text = "";
	}


	if (name.length >3) {
	document.getElementById("name-error").innerHTML = text;
	} else if(name.length < 3){
		document.getElementById("name-error").innerHTML = "Name must contain at least 3 characters.";
	}	else {
	document.getElementById("name-error").innerHTML = "";
	}
}


function msgChecker(){

	var message = document.getElementById("message").value;
	var text;
	

	
	

	if (message.length == 0){
		text = "Please fill in this field.";
		document.getElementById("msg-error").innerHTML = text;
	} 
	
	else if (message.length > 300){
		text = "Cannot exceed 300 word characters. Character count: ";
		document.getElementById("msg-error").innerHTML = text + experience.length;
	} 
	else if(message.length > 0 && message.length < 300){
		document.getElementById("msg-error").innerHTML = "";
	}



}

function numChecker() {
	var number = document.getElementById("number").value;
	var text;
  
	if (/^[89]/.test(number)) {
	  // Check if the input starts with 8 or 9 and has exactly 8 digits
	  document.getElementById("num-error").innerHTML = "";
	} else {
	  text = "Contact Number must start with 8 or 9.";
	  document.getElementById("num-error").innerHTML = text;
	}

	if (/^[89]/.test(number) && number.length > 8) {
	  text = "Contact Number can only have 8 digits.";
	  document.getElementById("num-error").innerHTML = text;
	} 
	else if (/^[89]/.test(number) && number.length < 8) {
	  text = "Contact Number must have 8 digits.";
      document.getElementById("num-error").innerHTML = text;
	} else if (/^[89]/.test(number) && number.length == 8) {
	document.getElementById("num-error").innerHTML = "";
	}
  }
  

  
  function rform1(){
	  document.getElementById("form2").reset();
  }




function init(){
	if(document &&document.getElementById) {
		var email = document.getElementById("email");
		email.onkeyup = emailChecker;
	}
	
	if(document &&document.getElementById) {
		var name = document.getElementById("name");
		name.onkeyup = nameChecker;
	}

	if(document &&document.getElementById) {
		var number = document.getElementById("number");
		number.onkeyup = numChecker;
	}

	if(document &&document.getElementById) {
		var message = document.getElementById("message");
		document.getElementById("msg-error").innerHTML = "Please fill in this field.";
		message.oninput = msgChecker;
	}
	
		
					
	
	
	if(document &&document.getElementById) {
		var form = document.getElementById("myForm");
		form.onsubmit = formChecker;
	}
	
}

window.onload = init;


