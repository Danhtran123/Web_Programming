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
				<a href="settings.php" class="content">Settings</a>
			</div>
			<div class = "front1">
				<div id="welcome" name="welcome"><?php if(isset($_SESSION['username'])){ echo "<h3>Welcome to Casino Adventure " . $_SESSION['username'] . "</h3>"; }?></div>
				<div id="daysLeftInSemester"></div>
				<div>
					<center>
        <div style="border:5px solid black;display:inline-block;width:30%;margin-right:3%;margin-top:1cm;text-align:center">
            <a href="./Games/Blackjack/blackjack.php"><img src="./Images/blackjackimg.png" style="width:80%;margin-top:1cm;margin-bottom:1cm;border:1px solid black"></a>
            <h2> Blackjack </h2>
            Get as high a score as you can without going over 21!<br><br><br>
        </div>
        <div style="border:5px solid black;display:inline-block;width:30%;margin-top:1cm;text-align:center">
            <a href="./Games/HoL/hol.php"><img src="./Images/holimg.png" style="width:80%;margin-top:1cm;margin-bottom:1cm;border:1px solid black"></a>
            <h2> Higher or Lower </h2>
            Correctly guess whether the next card drawn will be higher than the last to win big!<br><br>
        </div>
        <div style="border:5px solid black;display:inline-block;width:30%;margin-left:3%;margin-top:1cm;text-align:center">
           <a href="./Games/Dice/dice.php"> <img src="./Images/diceimg.png" style="width:80%;margin-top:1cm;margin-bottom:1cm;border:1px solid black"></a>
            <h2> 7/11 Dice </h2>
            Roll two dice and take home the jackpot if the sum is 7 or 11!<br><br><br>
        </div>
    </center>
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