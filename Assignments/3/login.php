<?php
	
	if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
	}
	
	
	session_start();
	
	
	if(isset($_POST['submit'])){
		$username= $_POST['username'];
		$password="guest";
		$enterpassword= $_POST['password'];
		if(isset($_POST['username']) && $enterpassword == $password){
			$_SESSION['username']=$username;
			header('location:protected.php');
		}
		else{
			$err = "Authentication Failed Try Again!";
		}
	}
	
	
?>

<!doctype HTML>
	<head>
	<title></title>
	</head>
	<body>
	<?php if(isset($err)){ echo $err; } ?>
		<form action="login.php" method="POST">
			<input type="text" id="username" name="username" value="<?php echo $username; ?>">
			<input type="text" id="password" name="password" value="<?php echo $enterpassword; ?>">
			<input type="hidden" id="postback" name="postback" value="true">
			<input type="submit" id="submit" name="submit" value="Submit">
		</form>
		<a href="protected.php">Homepage</a>
	</body>
</html>