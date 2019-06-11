// SELECTING ALL TEXT ELEMENTS
var address = document.forms['vform']['address'];
var email = document.forms['vform']['email'];
var password = document.forms['vform']['pass'];
var fname = document.forms['vform']['fname'];
var lname = document.forms['vform']['lname'];
// SELECTING ALL ERROR DISPLAY ELEMENTS
var email_error = document.getElementById('email_error');
var password_error = document.getElementById('password_error');
var address_error = document.getElementById('address_error');
var first_name_error = document.getElementById('firstname_error');
var last_name_error = document.getElementById('lastname_error');
// SETTING ALL EVENT LISTENERS
address.addEventListener('blur', nameVerify, true);
email.addEventListener('blur', emailVerify, true);
password.addEventListener('blur', passwordVerify, true);
fname.addEventListener('blur', fnameVerify, true);
lname.addEventListener('blur', lnameVerify, true);
// validation function
function Validate() {
  // validate address
  if (address.value == "") {
    address.style.border = "1px solid red";
    document.getElementById('address_div').style.color = "red";
    name_error.textContent = "Address is required";
    address.focus();
    return false;
  }
  // validate address
  if (address.value.length < 3) {
    address.style.border = "1px solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Address is too short";
    address.focus();
    return false;
  }
  // validate email
  if (email.value == "") {
    email.style.border = "1px solid red";
    document.getElementById('email_div').style.color = "red";
    email_error.textContent = "Email is required";
    email.focus();
    return false;
  }
  // validate password
  if (password.value == "") {
    password.style.border = "1px solid red";
    document.getElementById('password_div').style.color = "red";
    password_confirm.style.border = "1px solid red";
    password_error.textContent = "Password is required";
    password.focus();
    return false;
  }
  // check if the two passwords match
  if (password.value != password_confirm.value) {
    password.style.border = "1px solid red";
    document.getElementById('pass_confirm_div').style.color = "red";
    password_confirm.style.border = "1px solid red";
    password_error.innerHTML = "The two passwords do not match";
    return false;
  }
}
// event handler functions
function addressVerify() {
  if (username.value != "") {
    address.style.border = "1px solid #5e6e66";
   document.getElementById('address_div').style.color = "#5e6e66";
   address_error.innerHTML = "";
   return true;
  }
}
function emailVerify() {
  if (email.value != "") {
  	email.style.border = "1px solid #5e6e66";
  	document.getElementById('email_div').style.color = "#5e6e66";
  	email_error.innerHTML = "";
  	return true;
  }
}
function passwordVerify() {
  if (password.value != "") {
  	password.style.border = "1px solid #5e6e66";
  	document.getElementById('password_div').style.color = "#5e6e66";
  	password_error.innerHTML = "";
  	return true;
  }

}