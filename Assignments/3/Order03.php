<?php
	$fname= $_COOKIE[fname];
	$model= $_COOKIE[model];
	$color= $_POST['color'];
?>
<!doctype HTML>
	<head>
		<style>
			img{
				height: 700px;
				width: 800px;
			}
		</style>
	<title></title>
	</head>
	<body>
		<p>Hello <?= $fname ?> you have selected a <?= $color . " " . $model ?>!</p>
		<p><button onclick="location.href = './Order01.php';" id="button">Look at a new car!</button></p>
		<?php
			if($model == "Ford Mustang"){
				if($color == "red"){
					echo "<img src='./images/redfordmustang.jpg'>";
				}
				if($color == "blue"){
					echo "<img src='./images/bluefordmustang.jpg'>";
				}
				if($color == "yellow"){
					echo "<img src='./images/yellowfordmustang.jpg'>";
				}
			}
			else if($model == "Subaru WRX STI"){
				if($color == "red"){
					echo "<img src='./images/redsubaru.jpg'>";
				}
				if($color == "blue"){
					echo "<img src='./images/bluesubaru.jpg'>";
				}
				if($color == "yellow"){
					echo "<img src='./images/yellowsubaru.jpg'>";
				}
			}
			else if($model == "Corvette"){
				if($color == "red"){
					echo "<img src='./images/redcorvette.jpg'>";
				}
				if($color == "blue"){
					echo "<img src='./images/bluecorvette.jpg'>";
				}
				if($color == "yellow"){
					echo "<img src='./images/yellowcorvette.jpg'>";
				}
			}
		?>
	</body>
</html>