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

session_start();

	if($_SESSION['username'] == ""){
		header('location:login.php');
	}

$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
//if no cookie is created yet, grab money from database then set cookie to that value
	if(!isset($_COOKIE['money'])){
		$money = $_SESSION['money'];
		setcookie(money,$money, time()+(86400*30),"/");
//if cookie exists, grab money from cookie then use that value (other code uses cookie to store money (moneyHandler.js))
	} else if (isset($_COOKIE['money'])){
		$_SESSION['money'] = $_COOKIE['money'];
		$money = $_SESSION['money'];
	}
		
	if(isset($_POST['delete'])){
		$query = "DELETE FROM Casino_User_Info where username = '$username' and user_id = '$userid'";
		mysqli_query($conn,$query);
		session_unset();
		session_destroy();
		unset($_COOKIE['money']);
		setcookie('money',"",time()-(86400*30),"/");
		header('location:CasinoAdventure.php');
	}
	
//log out removes sessions & cookies
	if(isset($_POST['logout']) && $_POST['abandon'] == "true"){
		mysqli_query($conn,$query);
		session_unset();
		session_destroy();
		unset($_COOKIE['money']);
		setcookie('money',"",time()-(86400*30),"/");
		header('location:CasinoAdventure.php');
	}
	if(isset($_POST['login'])){
		header('location:login.php');
	}

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/carry.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Settings</title>
	</head>
	<body>
		<div class="backContainer">
		<h1 style="text-align:center; font-size:32pt;"> <?php if(isset($_SESSION['username'])){ echo $_SESSION['username'] . "'s" ;} ?> Casino Adventure </h1>
		<div class="navBar">
			<a href="CasinoAdventure.php">Home</a>
			<div class="dropdown">
				<button class="dropbtn">Games <i class="fa fa-caret-down"></i></button>
				<div class="dropdown-content">
					<a href="./Games/Blackjack/blackjack.php">Blackjack</a>
					<a href="./Games/HoL/hol.php">Higher/Lower</a>
					<a href="./Games/Dice/dice.php">7/11 Dice</a>
				</div>
			</div>
			<a href="deposit.php">Deposit</a>
			<div class="money"><?php echo "$" . $money; ?></div>
			<form action="CasinoAdventure.php" method="POST" name="logout">
				<input type="hidden" id="abandon" name="abandon" value="true">
				<?php if(!isset($_SESSION['username'])){ echo "<input type='submit' class='content' id='login' name='login' value='login'>"; }
					else{ echo "<input type='submit' class='content' id='logout' name='logout' value='logout' >";}?>
			</form>
			<a href="settings.php" class="content">Settings</a>
		</div>
		<form action="settings.php" method="POST" name="delete">
			<input type="submit" id="delete" name="delete" value="Delete Account">
		</form>
		</div>
	</body>
</html>