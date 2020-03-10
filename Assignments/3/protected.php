<?php
	
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:login.php');
	}
	
	$username = $_SESSION['username'];
	
	if(isset($_POST['logout']) && $_POST['abandon'] == "true"){
		session_unset();
		session_destroy();
		header('location:login.php');
	}
?>

<!doctype HTML>
	<head>
	<title></title>
	</head>
	<body>
		<p>Greetings <?php echo $username ?></p>
		<a href="protected.php">Homepage</a>
		<form action="protected.php" method="POST" name="logout">
			<input type="hidden" id="abandon" name="abandon" value="true">
			<input type="submit" id="logout" name="logout" value="logout" >
		</form>
	</body>
</html>