<?php
	//validate birthday
	function IsValidDate($date){
		$arr = explode('/',$date);
		if(checkdate($arr[0],$arr[1],$arr[2])){
			return true;
		}
		else{
			return false;
		}
	}
	
	//validate age
	function fIsValidRange($value, $min = "12", $max = "140"){
		if(is_numeric($value)){
			if($value >= $min && $value <= $max){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	//validate zipcode
	function fIsValidZipCode($value){
		if(is_numeric($value) && strlen($value) == 5){
			return true;
		}
		else{
			$errorMsg = "Not a valid zipcode";
			return false;
		}
	}
	//validate age
	function IsValidName($name){
		if($name == ""){
			$errorMsg = "Enter a name";
			return false;
		} else return true;
	}
	
	//validate email
	function IsValidEmail($email){
		if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)){
			return true;
		}
		else{
			return false;
		}
	}
?>