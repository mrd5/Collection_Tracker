function SettingsForm(event){
	var username = document.getElementById("username");
	var email = document.getElementById("email");
	var newpassword = document.getElementById("newpassword");
	var newpasswordconf = document.getElementById("newpasswordconf");
	var password = document.getElementById("password");
	var result = true;

	var passCheck = /^(\S*)?\d+(\S*)?$/;
	//Used to check password. Must contain at least one number
	
	var reg = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	//reg used to check email
	
	
	var letters = /^[A-Za-z]+$/;
	//Username can only contain letters. No spaces or non-word chars.

	//EMAIL
	if (email.value == ""){//Blank email field
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

	//NEW PASSWORD
	if (newpassword.value == "" && newpasswordconf.value != ""){//Blank password field
		document.getElementById("newpassword_msg").innerHTML = "Password can't be blank!";
		result = false;
	}
	else if (passCheck.test(newpassword.value) == false && newpassword.value.length < 8 && (newpasswordconf.value != "" || newpassword.value != "")){//Invalid password and is less than 8 chars
		document.getElementById("newpassword_msg").innerHTML = "Password must contain at least one number, and must be at least 8 characters long";
		result = false;
	}
	else if (passCheck.test(newpassword.value) == false && newpasswordconf.value != ""){//Valid length but invalid format (missing number)
		document.getElementById("newpassword_msg").innerHTML = "Password must contain at least one number";
		result = false;
	}
	else if (newpassword.value.length < 8 && newpasswordconf.value != ""){//Valid format but invalid length
		document.getElementById("newpassword_msg").innerHTML = "Password must be at least 8 characters long";
		result = false;
	}
	else{//Good password
		document.getElementById("newpassword_msg").innerHTML = "";
	}

	
	
	//CONFIRM PASSWORD
	if (newpasswordconf.value  == "" && newpassword.value != ""){//Blank confirm password field
		document.getElementById("newpasswordconf_msg").innerHTML = "Confirm password can't be left blank!";
		result = false;
	}
	else if (newpasswordconf.value != newpassword.value){//Confirm password doesn't match
		document.getElementById("newpasswordconf_msg").innerHTML = "Confirm password doesn't match password!";
		result = false;
	}
	else{//Confirm password matches password - Doesn't mean it is an acceptable password!
		document.getElementById("newpasswordconf_msg").innerHTML = "";
	}
	
	
	//USERNAME
	if (username.value == ""){//Blank username field
		document.getElementById("username_msg").innerHTML = "Username can't be blank!";
		result = false;
	}
	else if (letters.test(username.value) == false && username.value.length > 40){//Username contains a non letter AND is too long
		document.getElementById("username_msg").innerHTML = "Username can only contain letters and can't be greater than 40 characters";
		result = false;
	}
	else if (letters.test(username.value) == false){//Username is ok length but contains a non letter
		document.getElementById("username_msg").innerHTML = "Username can only contain letters";
		result = false;
	}
	else if (username.value.length > 40){//Username is just too long
		document.getElementById("username_msg").innerHTML = "Username can't be longer than 40 letters";
		result = false;
	}
	else{//Acceptable username
		document.getElementById("username_msg").innerHTML = "";
	}


	//OLD PASSWORD
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
	
	if (!result){//If there is at least one field with incorrect input, prevent the form from submitting.
		event.preventDefault();
	}
}