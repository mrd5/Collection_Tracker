function ResetForm(event){
	var password = document.getElementById("password");
	var passwordconf = document.getElementById("passwordconf");
	var result = true;
	var passCheck = /^(\S*)?\d+(\S*)?$/;

	//PASSWORD
	if (password.value == ""){//Blank password field
		document.getElementById("password_msg").innerHTML = "Password can't be blank!";
		result = false;
	}
	else if (passCheck.test(password.value) == false && password.value.length < 8){//Invalid password and is less than 8 chars
		document.getElementById("password_msg").innerHTML = "Password must contain at least one number, and must be at least 8 characters long";
		result = false;
	}
	else if (passCheck.test(password.value) == false){//Valid length but invalid format (missing number)
		document.getElementById("password_msg").innerHTML = "Password must contain at least one number";
		result = false;
	}
	else if (password.value.length < 8){//Valid format but invalid length
		document.getElementById("password_msg").innerHTML = "Password must be at least 8 characters long";
		result = false;
	}
	else{//Good password
		document.getElementById("password_msg").innerHTML = "";
	}


	//CONFIRM PASSWORD
	if (passwordconf.value  == ""){//Blank confirm password field
		document.getElementById("passwordconf_msg").innerHTML = "Confirm password can't be left blank!";
		result = false;
	}
	else if (passwordconf.value != password.value){//Confirm password doesn't match
		document.getElementById("passwordconf_msg").innerHTML = "Confirm password doesn't match password!";
		result = false;
	}
	else{//Confirm password matches password - Doesn't mean it is an acceptable password!
		document.getElementById("passwordconf_msg").innerHTML = "";
	}



	if (!result){
		event.preventDefault();
	}
}