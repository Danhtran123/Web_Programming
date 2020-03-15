<?php
	session_start();

	$moneyvalue = $_SESSION['money'];
	if(!isset($_COOKIE['money'])){
		setcookie(money,$moneyvalue, time()+(86400*30),"/");
	}
	$money = $_COOKIE['money'];
	
	if(isset($_POST['logout']) && $_POST['abandon'] == "true"){
		session_unset();
		session_destroy();
		setcookie(money,"",time()-(86400*30),"/");
		header('location:CasinoAdventure.php');
	}
	if(isset($_POST['login'])){
		header('location:login.php');
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title> Casino Adventure </title>
		<link rel="stylesheet" type="text/css" href="./css/style.css" title="style" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="./css/carry.css" title="style" />
	</head>
	<body onload="displayDate()">
		<div class = "backContainer">
			<h1 style="text-align:center; font-size:32pt;"> <?php if(isset($_SESSION['username'])){ echo $_SESSION['username'] . "'s" ;} ?> Casino Adventure </h1>
			<img class="chips" src="./Images/chips.png" alt="Casino chips">			
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
			</div>
			<div class = "front1">
				<div id="welcome" name="welcome"><?php if(isset($_SESSION['username'])){ echo "<h3>Welcome to Casino Adventure " . $_SESSION['username'] . "</h3>"; }?></div>
				<div id="daysLeftInSemester"></div>
				<div>
					<ul style="font-size:18pt">
						<span style="font-size:24pt">List of Games Here:</span>
						<li><a href="./Games/Blackjack/blackjack.php">Blackjack</a></li>
						<li><a href="./Games/HoL/hol.php">Higher/Lower</a></li>
						<li><a href="./Games/Dice/dice.php">7/11 Dice</a></li>
					</ul>
				</div>
				<h1><a href="https://www.youtube.com/watch?v=9TPTnm-TSK0">Youtube Video</a></h1>
			</div>
		</div>
		
		<script type="text/javascript">
			function displayDate() {
				var today=new Date();
				var month=0;
				var day=0;
				month=(today.getMonth()+1);
				day=today.getDate();
				var daysLeft=0;
				switch(month) {
					case 3:
					daysLeft=65-day;
					break;
					case 4:
					daysLeft=34-day;
					break;
					case 5:
					daysLeft=4-day;
					break;
				}
				var message="There are "+daysLeft+" days left in the semester.";
				document.getElementById("daysLeftInSemester").className="title";
				document.getElementById("daysLeftInSemester").innerHTML="<h3>" + message + "</h3";
			}
		</script>
	</body>
</html>