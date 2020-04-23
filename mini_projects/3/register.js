var password = document.getElementById("password");
var confirm_password = document.getElementById("confirm_password");
var email = document.getElementById("email");
var confirm_email = document.getElementById("confirm_email");

function validatePassword(){
	if(password.value != confirm_password.value) {
		confirm_password.setCustomValidity("Passwords Don't Match");
	} else {
		confirm_password.setCustomValidity('');
	}
}

function validateEmail(){
	if(email.value != confirm_email.value){
		confirm_email.setCustomValidity("Emails Don't Match");
	} else {
		confirm_email.setCustomValidity('');
	}
}
var days = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31];
var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
function populateDate(){
	var dob_day = document.getElementById("dob_day");
	var dob_month = document.getElementById("dob_month");
	var dob_year = document.getElementById("dob_year");
	var d = new Date();
	var year = d.getFullYear();
	for(var i=year; i>1900; i--){
		var option = document.createElement("option");
		option.text = i;
		option.value = i;
		dob_year.add(option);
	}
	for(var i=0; i<months.length; i++){
		var option = document.createElement("option");
		option.text = months[i];
		option.value = months[i];
		dob_month.add(option);
	}
	for(var i=0; i<days.length; i++){
		var option = document.createElement("option");
		option.text = days[i];
		option.value = days[i];
		dob_day.add(option);
	}
}

function activateSubmit(){
	var checkBox = document.getElementById("terms");
	var submitButton = document.getElementById("submit");
	if(checkBox.checked == true){
		submitButton.disabled = false;
	} else{
		submitButton.disabled = true;
	}
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
email.onchange = validateEmail;
confirm_email.onkeyup = validateEmail;

populateDate();