

// Submit form with id function
function userval() {
var name = document.getElementById("password").value;
var email = document.getElementById("email").value;
if (validation()) // Calling validation function
{
document.getElementById("form_id").action = "home.php"; // Setting form action to "success.php" page
document.getElementById("form_id").submit(); // Submitting form
}
}


function fb() {

document.getElementById("form_id").action = "Facebook.php"; // Setting form action to "success.php" page
document.getElementById("form_id").submit(); // Submitting form
} 

// Name and Email validation Function
function validation() {
var name = document.getElementById("password").value;
var email = document.getElementById("email").value;
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
if (name === '' || email === '') {
alert("Please fill all fields...!!!!!!");
return false;
} else if (!(email).match(emailReg)) {
alert("Please enter Valid Email Id!!");
return false;
} else {
return true;
}
}