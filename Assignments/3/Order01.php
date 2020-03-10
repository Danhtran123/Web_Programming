<?php
	if(isset($_COOKIE['fname']) && isset($_COOKIE['model'])){
		setcookie("fname","",time()-3600);
		setcookie("model","",time()-3600);
	}
?>
<!doctype HTML>
	<head>
	<title></title>
	</head>
	<body>
		<form action="Order02.php" method="POST">
			<table>
				<tr>
					<td><label for="fname">First name:</label></td>
					<td><input type="text" id="fname" name="fname" minlength="2" maxlength="20"></td>
				</tr>
				<tr>
					<td><label for="cmodel">Car model:</label></td>
					<td><label><input type="radio" id="mustang" name="model" value="Ford Mustang">Ford Mustang</label></td>
				</tr>
				<tr>
					<td></td>
					<td><label><input type="radio" id="subaru" name="model" value="Subaru WRX STI">Subaru WRX STI</label></td>
				</tr>
				<tr>
					<td></td>
					<td><label><input type="radio" id="corvette" name="model" value="Corvette">Corvette</label></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" id="submit" name="submit"></td>
				</tr>
			</table>
		</form>
	</body>
</html>