function LoginForm(event){
	var usernameOrEmail = document.getElementById("username");
	var loginPass = document.getElementById("password");

	var result = true; //changed to false if there is a value fails. Used to preventDefault()

	var passCheck = /^(\S*)?\d+(\S*)?$/;
	//Used to check password. Must contain at least one number
	
	var letters = /^[A-Za-z]+$/;
	//Username can only contain letters. No spaces or non-word chars.

	var reg = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	//reg used to check email
	


	//PASSWORD
	if (loginPass.value == ""){//Blank password field
		document.getElementById("pswdLogin_msg").innerHTML = "Password can't be blank!";
		result = false;
	}
	else if (passCheck.test(loginPass.value) == false && loginPass.value.length < 8){//Invalid password and is less than 8 chars
		document.getElementById("pswdLogin_msg").innerHTML = "Password must contain at least one number, and must be at least 8 characters long";
		result = false;
	}
	else if (passCheck.test(loginPass.value) == false){//Valid length but invalid format (missing number)
		document.getElementById("pswdLogin_msg").innerHTML = "Password must contain at least one number";
		result = false;
	}
	else if (loginPass.value.length < 8){//Valid format but invalid length
		document.getElementById("pswdLogin_msg").innerHTML = "Password must be at least 8 characters long";
		result = false;
	}
	else{//Good password
		document.getElementById("pswdLogin_msg").innerHTML = "";
	}


	//USERNAME
	if (usernameOrEmail.value.indexOf('@') == -1){
		if (usernameOrEmail.value == ""){//Blank username field
			document.getElementById("uname_msg").innerHTML = "Field can't be blank!";
			result = false;
		}
		else if (letters.test(usernameOrEmail.value) == false && usernameOrEmail.value.length > 40){//Username contains a non letter AND is too long
			document.getElementById("uname_msg").innerHTML = "Username can only contain letters and can't be greater than 40 characters";
			result = false;
		}
		else if (letters.test(usernameOrEmail.value) == false){//Username is ok length but contains a non letter
			document.getElementById("uname_msg").innerHTML = "Username can only contain letters";
			result = false;
		}
		else if (usernameOrEmail.value.length > 40){//Username is just too long
			document.getElementById("uname_msg").innerHTML = "Username can't be longer than 40 letters";
			result = false;
		}
		else{//Acceptable username
			document.getElementById("uname_msg").innerHTML = "";
		}	
	}
	if (usernameOrEmail.value.indexOf('@') > -1){//EMAIL
		if (reg.test(usernameOrEmail.value) == false && usernameOrEmail.value.length > 60){//Invalid and too long email
			document.getElementById("uname_msg").innerHTML = "Email must be a valid format: someone@somewhere.etc and must be no more than 60 characters long";
			result = false;
		}
		else if (reg.test(usernameOrEmail.value) == false){//Valid length email but invalid format
			document.getElementById("uname_msg").innerHTML = "Email must be a valid format: someone@somewhere.etc";
			result = false;
		}
		else if (usernameOrEmail.value.length > 60){//Valid format but invalid length
			document.getElementById("uname_msg").innerHTML = "Email must be no longer than 60 characters";
			result = false;
		}
		else{//Email is acceptable
			document.getElementById("uname_msg").innerHTML = "";
		}
	}


	if (!result){
		event.preventDefault();
	}



}