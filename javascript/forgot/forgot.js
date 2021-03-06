function ForgotForm(event){
	var email = document.getElementById("email");
	var result = true;
	var reg = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	//reg used to check email

	//EMAIL
	if (email.value == "" || email.value == null){//Blank email field
		document.getElementById("email_msg").innerHTML = "Email can't be blank!";
		result = false;
	}
	else if (reg.test(email.value) == false && email.value.length > 60){//Invalid and too long email
		document.getElementById("email_msg").innerHTML = "Email must be a valid format: someone@somewhere.etc and must be no more than 60 characters long";
		result = false;
	}
	else if (reg.test(email.value) == false){//Valid length email but invalid format
		document.getElementById("email_msg").innerHTML = "Email must be a valid format: someone@somewhere.etc";
		result = false;
	}
	else if (email.value.length > 60){//Valid format but invalid length
		document.getElementById("email_msg").innerHTML = "Email must be no longer than 60 characters";
		result = false;
	}
	else{//Email is acceptable
		document.getElementById("email_msg").innerHTML = ""
	}


	if (!result){
		event.preventDefault();
	}
}