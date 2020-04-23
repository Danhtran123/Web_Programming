<?php
	//autodirect to HTTPS
	if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
	}
$servername = "localhost";
$username = "dtran54";
$password = "dtran54";
$dbname = "dtran54";
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}
	
	session_start();
	
	//pulls user_id and money from mysql database if username and password is correct.
	if(isset($_POST['login'])){
		$enterusername = mysqli_real_escape_string($conn, $_POST['username']);
		$enterpassword= mysqli_real_escape_string($conn, $_POST['password']);
		
		$query = "SELECT user_id, money FROM Casino_User_Info where username = '$enterusername' and pass = '$enterpassword'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$money = $row['money'];
		$userid = $row['user_id'];
		$count = mysqli_num_rows($result);
				
		if($count == 1){
			$_SESSION['username'] = $enterusername;
			$_SESSION['money'] = $money;
			$_SESSION['userid'] = $userid;
			Header("Location: CasinoAdventure.php");
		} else {
			$err = "Your username or password is invalid";
		}
	}
?>
<!doctype HTML>
	<head>
		<script src="./js/login.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/carry.css">
	<link rel="stylesheet" type="text/css" href="./css/login.css">
	<title></title>
	</head>
	<body>
		<div class="container">
			<div class="main">
			<h2>Login</h2>
			<?php if(isset($err)){ echo "<div style='color:red'> $err </div>"; } ?>
			<form method="POST" name="login" onsubmit="return ValidateForms()">
				<div id="errorusername"></div>
				<input type="text" id="username" name="username" placeholder="USERNAME">
				<div id="errorpassword"></div>
				<input type="password" id="password" name="password" placeholder="PASSWORD">
				<input type="submit" id="login" name="login" value="SIGN IN">
			</form>
			No Account?
			<input type="button" onclick="location.href='register.html';" value="Sign up">
			</div>
		</div>
	</body>
</html>