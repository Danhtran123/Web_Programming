<?php
	$fname= $_POST['fname'];
	$model= $_POST['model'];
	$color= $_POST['color'];

	if((strlen($fname) > 2 || strlen($fname) < 20) && $model == "Corvette" || $model == "Ford Mustang" || $model == "Subaru WRX STI" ){
		setcookie("fname",$fname,time()+36000);
		setcookie("model",$model,time()+36000);
	}
	else{
		echo "Some information is not valid";
		exit();
	}
?>

<!doctype HTML>
	<head>
	<title></title>
	</head>
	<body>
		<form action="Order03.php" id="color" name="color" method="POST">
			<label for="color">Car color:</label> <br />
			<select id="color" name="color">
				<option value="red" id="red" name="color" style="background-color:red">RED</option>
				<option value="blue" id="blue" name="color" style="background-color:blue">BLUE</option>
				<option value="yellow" id="yellow" name="color" style="background-color:yellow">YELLOW</option>	
			</select>
			<input type="submit" id="submit" name="submit">
		</form>
	</body>
	
	<?php
		echo $color;
	?>
</html>