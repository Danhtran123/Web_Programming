<?php
	//autodirect to HTTPS
	if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
	}
	
	session_start();
	
	//check for correct username and password, applies username session and money (eventually pulls from database)
	if(isset($_POST['login'])){
		$username="admin";
		$password="password";
		$enterusername = $_POST['username'];
		$enterpassword= $_POST['password'];
		if($username == $enterusername && $enterpassword == $password){
			$_SESSION['username']=$enterusername;
			$_SESSION['money']=0;
			header('location:CasinoAdventure.php');
		}
		else{
			$err = "Failed to Authenticate";
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
			</div>
		</div>
	</body>
</html>