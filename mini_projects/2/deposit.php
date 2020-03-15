<?php
	//autodirect to HTTPS
	if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
	}
	
	session_start();
	if($_SESSION['username'] == ""){
		header('location:login.php');
	}
	$moneyvalue = $_SESSION['money'];
	if(!isset($_COOKIE['money'])){
		setcookie(money,$moneyvalue, time()+(86400*30),"/");
	}
	else{
		
	}
	$money = $_COOKIE['money'];
	
	if(isset($_POST['logout']) && $_POST['abandon'] == "true"){
		session_unset();
		session_destroy();
		setcookie(money,"",time()-(86400*30),"/");
		header('location:CasinoAdventure.php');
	}
?>
<!doctype html5>
	<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/deposit.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./css/carry.css">
	<title></title>
	</head>
	<body>
		<div class = "backContainer">
			<h1 style="text-align:center; font-size:32pt;"> <?php echo $_SESSION['username'] . "'s"; ?> Casino Adventure </h1>
			<img class="chips" src="chips.png" alt="Casino chips">			
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
				<a href="">Deposit</a>
				<div id="money" class="money"><?php echo "$" . $money; ?></div>
				<form action="CasinoAdventure.php" method="POST" name="logout">
					<input type="hidden" id="abandon" name="abandon" value="true">
					<?php if(!isset($_SESSION['username'])){ echo "<input type='submit' class='content' id='login' name='login' value='login'>"; }
							else{ echo "<input type='submit' class='content' id='logout' name='logout' value='logout' >";}?>
				</form>
			</div>
			
			<div class="container">
			<div class="main">
				<button class="money1" id="deposit" name="deposit" onclick="AddMoney()">Deposit</button>
				<button class="money1" id="withdraw" name="withdraw" onclick="RemoveMoney()">Withdraw</button>
			</div>
		</div>
		</div>
			<script type="text/javascript" src="./js/moneyHandler.js">
	</script>
	</body>
</html>