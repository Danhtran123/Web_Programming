<?php
require("../../config.php");
	session_start();
	if($_SESSION['username'] == ""){
		header('location:../../login.php');
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
	$query = "UPDATE Casino_User_Info SET money = '$money' WHERE username = '$username' and user_id = '$userid'";
	
	if(isset($_POST['logout']) && $_POST['abandon'] == "true"){
		mysqli_query($conn,$query);
		session_unset();
		session_destroy();
		unset($_COOKIE['money']);
		setcookie('money',"",time()-(86400*30),"/");
		header('location:CasinoAdventure.php');
	}
?>
<!DOCTYPE html5>
	<head>
		<title>7/11 Dice</title>
		<link rel="stylesheet" type="text/css" href="carry.css" title="style" />
		<link rel="stylesheet" type="text/css" href="game.css" title="style" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class = "backContainer">
			<h1 style="text-align:center; font-size:32pt;"> <?php if(isset($_SESSION['username'])){ echo $_SESSION['username'] . "'s" ;} ?> Casino Adventure </h1>
			<img class="chips" src="chips.png" alt="Casino chips">
			<div class="navBar">
				<a href="../../CasinoAdventure.php">Home</a>
				<div class="dropdown">
					<button class="dropbtn">Games <i class="fa fa-caret-down"></i></button>
					<div class="dropdown-content">
						<a href="../Blackjack/blackjack.php">Blackjack</a>
						<a href="../HoL/hol.php">Higher/Lower</a>
						<a href="./dice.php">7/11 Dice</a>
					</div>
				</div>
				<a href="../../deposit.php">Deposit</a>
				<div class="money" id="money" name="money"><?php echo "$" . $money; ?></div>
				<form action="../../CasinoAdventure.php" method="POST" name="logout">
					<input type="hidden" id="abandon" name="abandon" value="true">
					<?php if(!isset($_SESSION['username'])){ echo "<input type='submit' class='content' id='login' name='login' value='login'>"; }
							else{ echo "<input type='submit' class='content' id='logout' name='logout' value='logout' >";}?>
				</form>
				<a href="../../settings.php" class="content">Settings</a>
			</div>
			<div class="game-container">
				<div style="text-align:center">
					<div class="title" style="margin-bottom:1cm">
						<h2> Roll a 7 or an 11 and you win! </h2>
					</div>
					<div id="result" style="font-size:24pt"></div>
				</div>
				<div class="cards-container" style="text-align:center">
					<img id="die1" src="dice6.png" alt="first die" style="margin-right:2cm">
					<img id="die2" src="dice6.png" alt="second die">
				</div>
				<div class="move-container" style="font-size:16pt;font-style:bold">
					Bet: $
					<div id="bet" class="bet"></div>
					<button type="button" id="button1" onclick="decreaseBet()" class="bet">-</button>
					<button type="button" id="button2" onclick="increaseBet()" class="bet">+</button>
					<div><button type="button" id="confirm" name="confirm" onclick="confirmBet()" class="move-action confirm">Confirm Bet</button></div>
					<button type="button" id="button3" onclick="" class="move-action" style="font-size:16pt;width:4cm">Roll the Dice</button>
				</div>
				
				<div id="newGame" style="text-align:center;margin-bottom:2cm"></div>
			</div>
		</div>
	<script type="text/javascript">
		var betAmount=0;
		document.getElementById("bet").innerHTML=betAmount;
		var money = getCookie("money");
		money = parseInt(money);
		function getCookie(cname) {
			var name = cname + "=";
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			for(var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}	
		function setCookie(cname,cvalue,exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays*24*60*60*1000));
			var expires = "expires=" + d.toGMTString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}
		
		function rollTheDice()
		{
			var firstRoll=Math.floor(Math.random()*6)+1;
			var secondRoll=Math.floor(Math.random()*6)+1;
			var temp1="dice"+firstRoll+".png";
			var temp2="dice"+secondRoll+".png";
			console.log(temp1);
			console.log(temp2);
			document.getElementById("die1").src=temp1;
			document.getElementById("die2").src=temp2;
			var sum=firstRoll+secondRoll;
			if(sum==7||sum==11)
			{
				money+=betAmount*2
				document.getElementById("money").innerHTML = "$" + money;
				document.getElementById("result").className="title";
				document.getElementById("result").style.width="5cm";
				document.getElementById("result").innerHTML="You win!!";
				disableGame();
				return false;
			}
			else
			{
				document.getElementById("result").className="title";
				document.getElementById("result").style.width="5cm";
				document.getElementById("result").innerHTML="You lose.";
				disableGame();
				return false;
			}
		}
		function increaseBet() {
				if(betAmount<money){
					betAmount+=25;
				}
				document.getElementById("bet").innerHTML=betAmount;
			}
		function decreaseBet() {
			if(betAmount>0)
			{
				betAmount-=25;
			}
			document.getElementById("bet").innerHTML=betAmount;
		}
		function confirmBet(){
			money-=betAmount;
			document.getElementById("money").innerHTML = "$" + money;
			document.getElementById("confirm").onclick="";
			document.getElementById("button1").onclick="";
			document.getElementById("button2").onclick="";
			document.getElementById("button3").onclick=rollTheDice;
		}
		function disableGame() {
			document.getElementById("button1").onclick="";
			document.getElementById("button2").onclick="";
			document.getElementById("button3").onclick="";
			document.getElementById("newGame").innerHTML='<button type="button" class="move-action" onclick="window.location.href=\'dice.php\';">New Game</button>'
			setCookie("money",money);
		}
	</script>
	</body>
</html>