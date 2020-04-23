<?php
$servername = "localhost";
$username = "dtran54";
$password = "dtran54";
$dbname = "dtran54";
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
	console.log("Failed to connect to database, killing webpage");
	die("Connection failed: " . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$dob_day = $_POST["dob_day"];
$dob_month = $_POST["dob_month"];
$dob_year = $_POST["dob_year"];
$birthdate = $dob_month." ".$dob_day." ".$dob_year;
$sex = $_POST["sex"];
$country = $_POST["country"];
$state = $_POST["state"];
$city = $_POST["city"];
$zipcode = $_POST["zipcode"];

//Reformatting birthdate to fit the mysql birthdate form. MM/DD/YYYY -> YYYY-MM-DD
$birthdate = date('Y-m-d', strtotime($birthdate));

$query = "INSERT INTO Casino_User_Info (username, pass, email, first_name, last_name, birth_date, sex, country, state, city, zip_code, money)
	Values('$username', '$password', '$email', '$fname', '$lname', '$birthdate', '$sex', '$country', '$state', '$city', '$zipcode', 0)";
	
if($conn -> query($query) === TRUE){
	header("Location: login.php");
} else {
	header("Location: register.html");
}
?>