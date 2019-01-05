//event listener for the submit button
document.getElementById("SUBMIT").addEventListener("click", ContactForm, false);


//Event listeners for text area. Used to count and display the entered number of characters in real time. 
document.getElementById("message").addEventListener("focus", CountChars, false);
document.getElementById("message").addEventListener("keyup", CountChars, false);
document.getElementById("message").addEventListener("keydown", CountChars, false);