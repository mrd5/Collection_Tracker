function RegisterForm(event){
	var loginEmail= document.getElementById("email");
	var loginPass = document.getElementById("password");
	var loginPassConf = document.getElementById("passwordconf");
	var username =  document.getElementById("username");
	var result = true; //Will be changed to false if any fields in the form have been entered incorrectly to prevent the form from submitting
	
	// /^(\S*)?\d+(\S*)?$/;
	var passCheck = /^(\S*)?\d+(\S*)?$/;
	//Used to check password. Must contain at least one number
	
	var reg = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	//reg used to check email
	
	
	var letters = /^[A-Za-z]+$/;
	//Username can only contain letters. No spaces or non-word chars.

	//EMAIL
	if (loginEmail.value == ""){//Blank email field
		document.getElementById("emailLogin_msg").innerHTML = "Email can't be blank!";
		result = false;
	}
	else if (reg.test(loginEmail.value) == false && loginEmail.value.length > 60){//Invalid and too long email
		document.getElementById("emailLogin_msg").innerHTML = "Email must be a valid format: someone@somewhere.etc and must be no more than 60 characters long";
		result = false;
	}
	else if (reg.test(loginEmail.value) == false){//Valid length email but invalid format
		document.getElementById("emailLogin_msg").innerHTML = "Email must be a valid format: someone@somewhere.etc";
		result = false;
	}
	else if (loginEmail.value.length > 60){//Valid format but invalid length
		document.getElementById("emailLogin_msg").innerHTML = "Email must be no longer than 60 characters";
		result = false;
	}
	else{//Email is acceptable
		document.getElementById("emailLogin_msg").innerHTML = ""
	}

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

	
	
	//CONFIRM PASSWORD
	if (loginPassConf.value  == ""){//Blank confirm password field
		document.getElementById("pswdrLogin_msg").innerHTML = "Confirm password can't be left blank!";
		result = false;
	}
	else if (loginPassConf.value != loginPass.value){//Confirm password doesn't match
		document.getElementById("pswdrLogin_msg").innerHTML = "Confirm password doesn't match password!";
		result = false;
	}
	else{//Confirm password matches password - Doesn't mean it is an acceptable password!
		document.getElementById("pswdrLogin_msg").innerHTML = "";
	}
	
	
	//USERNAME
	if (username.value == ""){//Blank username field
		document.getElementById("uname_msg").innerHTML = "Username can't be blank!";
		result = false;
	}
	else if (letters.test(username.value) == false && username.value.length > 40){//Username contains a non letter AND is too long
		document.getElementById("uname_msg").innerHTML = "Username can only contain letters and can't be greater than 40 characters";
		result = false;
	}
	else if (letters.test(username.value) == false){//Username is ok length but contains a non letter
		document.getElementById("uname_msg").innerHTML = "Username can only contain letters";
		result = false;
	}
	else if (username.value.length > 40){//Username is just too long
		document.getElementById("uname_msg").innerHTML = "Username can't be longer than 40 letters";
		result = false;
	}
	else{//Acceptable username
		document.getElementById("uname_msg").innerHTML = "";
	}
	
	if (!result){//If there is at least one field with incorrect input, prevent the form from submitting.
		event.preventDefault();
	}
}