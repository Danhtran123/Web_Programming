<?php
	session_start();
	
	if($_SESSION['username'] == ""){
		header('location:../../login.php');
	}

	if($_COOKIE['money'] != ""){
		$_SESSION['money'] = $_COOKIE['money'];
	}
	
	$moneyvalue = $_SESSION['money'];
	if(!isset($_COOKIE['money'])){
		setcookie(money,$moneyvalue, time()+(86400*30),"/");
	}
	$money = $_COOKIE['money'];
	
	if(isset($_POST['logout']) && $_POST['abandon'] == "true"){
		session_unset();
		session_destroy();
		setcookie(money,"",time()-(86400*30),"/");
		header('location:../../CasinoAdventure.php');
	}
?>
	
<!DOCTYPE html5>
	<head>
		<title>Blackjack</title>
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
						<a href="./blackjack.php">Blackjack</a>
						<a href="../HoL/hol.php">Higher/Lower</a>
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
			</div>
			<div class="game-container">
			
				<div>
					<div class="title">
						<h2> BlackJack </h2>
					</div>
				</div>
				<div class="cards-container" style="margin-top:0.5cm">
					<div class="cards-sub-container">
						<div class="player">Dealer</div>
						<img id="dcard1" class="card" alt="Dealer Card">
						<img id="dcard2" class="card" src="cardback.png" alt="cardback">
					</div>
					<div class="cards-sub-container">
						<div class="player">Player</div>
						<img id="pcard1" class="card" src="ace_spades.png" alt="Player Card">
						<img id="pcard2" class="card" src="10_diamonds.png" alt="Player Card">
						<img id="pcard3">
						<img id="pcard4">
						<img id="pcard5">
					</div>
				</div>
				<div id="result" style="font-size:24pt"></div>
				<div class="move-container" style="font-size:16pt;font-style:bold">
					Bet: $
					<div id="bet" class="bet"></div>
					<button type="button" id="button1" onclick="decreaseBet()" class="bet">-</button>
					<button type="button" id="button2" onclick="increaseBet()" class="bet">+</button>
					<div><button type="button" id="confirm" name="confirm" onclick="confirmBet()" class="move-action confirm">Confirm Bet</button></div>
					<div>
					<button type="button" id="button3" onclick="" class="move-action">Hit</button>
					<button type="button" id="button4" onclick="" class="move-action">Stand</button>
					</div>
				</div>
				<div id="newGame" style="text-align:center;margin-bottom:2cm"></div>
			</div>
		</div>
	<script type="text/javascript">
			var betAmount=0;
			document.getElementById("bet").innerHTML=betAmount;
			var dealerScore=0;
			var playerScore=0;
			var aceCounter=0;

			// First array is suite (clubs, diamonds, hearts, spades in order)
			// Second array is number
			var deck=[[],
			[0,0,0,0,0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,0,0,0,0,0]]; // Keeps track of already-dealt cards
			var dealtCards=new Array(); // [0] & [1] Dealer's Cards, [2]+ Player's Cards
			var newCardCounter=4;
			
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
			
			for(i=0;i<4;i++)
			{
				var number=Math.floor(Math.random()*13)+1;
				var suite=Math.floor(Math.random()*4)+1;
				while(deck[suite][number]!=0) // Making sure an unused card is picked
				{
					number=Math.floor(Math.random()*13)+1;
					suite=Math.floor(Math.random()*4)+1;
				}
				deck[suite][number]=1;
				var realsuite=""
				switch(suite) {
				case 1:
				realsuite="C";
				break;
				case 2:
				realsuite="D";
				break;
				case 3:
				realsuite="H";
				break;
				case 4:
				realsuite="S";
				break;
				}
				var cardname=number+""+realsuite;
				dealtCards[i]=cardname;
				if(i<2)
				{
					if(number==1)
					{
						dealerScore+=11;
					}
					else if(number<10)
					{
						dealerScore+=number;
					}
					else
					{
						dealerScore+=10;
					}
				}
				else
				{
					if(number==1){ 
						playerScore+=11;
						if(playerScore>21)
						{
							playerScore-=10;
						}
					}
					else if(number<10)
					{
						playerScore+=number;
					}
					else
					{
						playerScore+=10;
					}
				}
			}
			for(i=0;i<4;i++)
			{
				var card1=dealtCards[i];
				var temp=card1+".png";
				switch(i) {
				case 0:
				document.getElementById("dcard1").src=temp;
				break;
				case 2:
				document.getElementById("pcard1").src=temp;
				break;
				case 3:
				document.getElementById("pcard2").src=temp;
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
				document.getElementById("button3").onclick=hit;
				document.getElementById("button4").onclick=endGame;
				document.getElementById("button1").onclick="";
				document.getElementById("button2").onclick="";
			}
			function hit() {
				var number=Math.floor(Math.random()*13)+1;
				var suite=Math.floor(Math.random()*4)+1;
				while(deck[suite][number]!=0) // Making sure an unused card is picked
				{
					number=Math.floor(Math.random()*13)+1;
					suite=Math.floor(Math.random()*4)+1;
				}
				deck[suite][number]=1;
				var realsuite=""
				switch(suite) {
				case 1:
				realsuite="C";
				break;
				case 2:
				realsuite="D";
				break;
				case 3:
				realsuite="H";
				break;
				case 4:
				realsuite="S";
				break;
				}
				var cardname=number+""+realsuite;
				dealtCards[newCardCounter]=cardname;
				var temp=cardname+".png";
				var temp1=newCardCounter-1;
				var temp2="pcard"+temp1;
				document.getElementById(temp2).src=temp;
				document.getElementById(temp2).style.height="200px";
				document.getElementById(temp2).style.padding="50px 10px";
				if(number==1)
				{
					playerScore+=11;
					aceCounter++;
					if(playerScore>21)
					{
						playerScore-=10;
						aceCounter--;
					}
				}
				else if(number<10)
				{
					playerScore+=number;
					if(playerScore>21)
					{
						if(aceCounter>0)
						{
							playerScore=-10;
							aceCounter--;
						}
						else
						{
							endGame();
						}
					}
					else if(newCardCounter>5)
					{
						endGame();
					}
				}
				else
				{
					playerScore+=10;
					if(playerScore>21)
					{
						if(aceCounter>0)
						{
							playerScore=-10;
							aceCounter--;
						}
						else
						{
							endGame();
						}
					}
					else if(newCardCounter>5)
					{
						endGame();
					}
				}
				newCardCounter++;
			}
			function endGame()
			{
				var temp=dealtCards[1];
				var temp1=temp+".png";
				document.getElementById("dcard2").src=temp1;
				if(dealtCards[6]!=null&&playerScore<=21)
				{
					money+=betAmount*2
					document.getElementById("money").innerHTML = "$" + money;
					document.getElementById("result").className="title";
					document.getElementById("result").style.width="5cm";
					document.getElementById("result").innerHTML="You win!!";
					disableGame();
				}
				else if(playerScore<=21&&playerScore>dealerScore)
				{
					money+=betAmount*2
					document.getElementById("money").innerHTML = "$" + money;
					document.getElementById("result").className="title";
					document.getElementById("result").style.width="5cm";
					document.getElementById("result").innerHTML="You win!!";
					disableGame();
				}
				else
				{
					document.getElementById("result").className="title";
					document.getElementById("result").style.width="5cm";
					document.getElementById("result").innerHTML="You lose.";
					disableGame();
				}
			}
			function disableGame() {
				document.getElementById("button1").onclick="";
				document.getElementById("button2").onclick="";
				document.getElementById("button3").onclick="";
				document.getElementById("button4").onclick="";
				document.getElementById("newGame").innerHTML='<button type="button" class="move-action" onclick="window.location.href=\'blackjack.php\';">New Game</button>';
				setCookie("money",money);
			}
			</script>
	</body>
</html>