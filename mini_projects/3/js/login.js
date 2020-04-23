function ValidateForms(){
			var username = document.forms["login"]["username"].value;
			var password = document.forms["login"]["password"].value;
			if(username == "" || password == ""){
				if(username.length < 3 || username.length > 20){
					document.getElementById("errorusername").innerHTML = "<span style='color: red'>Must be between 3 and 20 characters</span>";
					return false;
				}
				else{
					document.getElementById("errorusername").innerHTML = "";
				}
				if(password == ""){
					document.getElementById("errorpassword").innerHTML = "<span style='color: red'>Input a password</span>";
					return false;
				}
				else{
					document.getElementById("errorpassword").innerHTML = "";
				}
				return false;
			}
		}