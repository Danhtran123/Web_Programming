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
		<title>Higher Or Lower</title>
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
						<a href="./hol.php">Higher/Lower</a>
						<a href="../Dice/dice.php">7/11 Dice</a>
					</div>
				</div>
				<a href="../../deposit.php">Deposit</a>
				<div class="money" id="money" name="money"><?php echo "$" . $money; ?></div>
				<form action="../../CasinoAdventure.php" method="POST" name="logout">
					<input type="hidden" id="abandon" name="abandon" value="true">
					<?php if(!isset($_SESSION['username'])){ echo "<input type='submit' class='content' id='login' name='login' value='login'>"; }
							else{ echo "<input type='submit' class='content' id='logout' name='logout' value='logout' >";}?>
				</form>
				<a href="settings.php" class="content">Settings</a>
			</div>
			<div class="game-container">
				<div style="text-align:center">
					<div class="title">
						<h2> Higher or Lower? </h2>
					</div>
					<div id="result" style="font-size:24pt"></div>
				</div>
				<div style="margin-top:1cm;text-align:center;font-size:18pt">
					<b>Current Card</b>
				</div>
				<div class="cards-container">
					<img id="currentCard" class="card" src="ace_spades.png" alt="cardback">
					<img id="newCard" class="card" src="cardback.png" alt="cardback" style="margin-left:1m">
				</div>
				<div class="move-container" style="font-size:16pt">
					Bet: $
					<div id="bet" class="bet"></div>
					<button type="button" id="button1" onclick="decreaseBet()" class="bet">-</button>
					<button type="button" id="button2" onclick="increaseBet()" class="bet">+</button>
					<div><button type="button" id="confirm" name="confirm" onclick="confirmBet()" class="move-action confirm">Confirm Bet</button></div>
					<form name="myForm">
						<input type="radio" id="higher1" name="higherOrLower" value="1" required> 
						<label for="higher1">Higher</label><br>
						<input type="radio" id="lower1" name="higherOrLower" value="0" required>
						<label for="lower1">Lower</label><br><br>
						<input type="button" id="submit" value="Flip Card" class="move-action" style="font-size:16pt;width:3cm">
					</form>
				</div>
				<div id="newGame" style="text-align:center;margin-bottom:2cm"></div>
			</div>
		</div>
	<script type="text/javascript">
		var betAmount=0;
		document.getElementById("bet").innerHTML=betAmount;
		var suite1=Math.floor(Math.random()*4)+1;
		var number1=Math.floor(Math.random()*13)+1;
		var suite2=Math.floor(Math.random()*4)+1;
		var number2=Math.floor(Math.random()*13)+1;
		
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
		
		while(suite1==suite2&&number1==number2)
		{
			suite2=Math.floor(Math.random()*4)+1;
			number2=Math.floor(Math.random()*13)+1;
		}
		var realsuite1=""
		var realsuite2=""
		switch(suite1) {
			case 1:
			realsuite1="C";
			break;
			case 2:
			realsuite1="D";
			break;
			case 3:
			realsuite1="H";
			break;
			case 4:
			realsuite1="S";
			break;
		}
		switch(suite2) {
			case 1:
			realsuite2="C";
			break;
			case 2:
			realsuite2="D";
			break;
			case 3:
			realsuite2="H";
			break;
			case 4:
			realsuite2="S";
			break;
		}
		var temp1=number1+""+realsuite1+".png";
		var temp2=number2+""+realsuite2+".png";
		document.getElementById("currentCard").src=temp1;
		function flipCard() {
			
			document.getElementById("newCard").src=temp2;
			var hol=document.forms["myForm"]["higherOrLower"].value;
			if(number1==number2)
			{
				money+=betAmount;
				document.getElementById("money").innerHTML = "$" + money;
				document.getElementById("result").className="title";
				document.getElementById("result").style.width="5cm";
				document.getElementById("result").innerHTML="It's a tie.";
				disableGame();
				return false;
			}
			else if(hol==1&&number2>number1)
			{
				money+=betAmount*2
				document.getElementById("money").innerHTML = "$" + money;
				document.getElementById("result").className="title";
				document.getElementById("result").style.width="5cm";
				document.getElementById("result").innerHTML="You win!!";
				disableGame();
				return false;
			}
			else if(hol==0&&number2<number1)
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
			betAmount+=25;
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
			document.getElementById("higher1").disabled = true;
			document.getElementById("lower1").disabled = true;
			document.getElementById("submit").onclick=flipCard;
		}
		function disableGame() {
			document.getElementById("button1").onclick="";
			document.getElementById("button2").onclick="";
			document.getElementById("submit").onclick="";
			document.getElementById("newGame").innerHTML='<button type="button" class="move-action" onclick="window.location.href=\'hol.php\';">New Game</button>'
			setCookie("money",money);
		}
	</script>
	</body>
</html>