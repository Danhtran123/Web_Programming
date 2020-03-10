<!DOCTYPE html>
	<head>
		<style>
			.errorMsg{
				border: 1px solid red;
			}
			.message{
				color: red;
				font-weight: bold;
			}
		</style>
	<title></title>
	</head>
	<body>
		<?php
			include 'ValidationUtilities.php';
			
			$email;
			$name;
			$birthday;
			$age;
			$state;
			$zip;
			
			echo $errorMsg;
			
			if(isset($_POST['valid'])){
				
				$email = $_POST['email'];
				$name = $_POST['fname'];
				$birthday = $_POST['birthday'];
				$age = $_POST['age'];
				$state = $_POST['state'];
				$zip = $_POST['zip'];
			}
			
			if(isset($_POST['notvalid'])){
				
			}
		?>
	
		<div class="container">
			<form style="text align: center;" action="validateConfirm.php" method="POST">
				<table>
					<tr>
						<td class="tag"><label for="email">Email:</label></td>
						<td><input type="text" id="email" name="email" placeholder="Email" <?php if(!IsValidEmail($email) && isset($_POST['valid'])){ echo "class=errorMsg"; } ?>><?php if(!IsValidEmail($email) && isset($_POST['valid'])){ echo "Not valid email"; } ?></td>
					</tr>
					<tr>
						<td class="tag"><label for="fname">First name:</label></td>
						<td><input type="text" id="fname" name="fname" placeholder="First name" <?php if(!IsValidName($name) && isset($_POST['valid'])){ echo "class=errorMsg"; }?>><?php if(!IsValidName($name) && isset($_POST['valid'])){ echo "Enter a name!"; }?></td>
					</tr>
					<tr>
						<td class="tag"><label for="birthday">Birthday:</label></td>
						<td><input type="text" id="birthday" name="birthday" placeholder="mm/dd/yyyy" <?php if(!IsValidDate($birthday) && isset($_POST['valid'])){ echo "class=errorMsg"; } ?>><?php if(!IsValidDate($birthday) && isset($_POST['valid'])){ echo "Not a correct date"; }?></td>
					</tr>
					<tr>
						<td class="tag"><label for="age">Age:</label></td>
						<td><input type="text" id="age" name="age" placeholder="age" <?php if(!fIsValidRange($age) && isset($_POST['valid'])){ echo "class=errorMsg"; } ?>><?php if(!fIsValidRange($age) && isset($_POST['valid'])){ echo "Not a valid age"; } ?></td>
					</tr>
					<tr>
						<td class="tag"><label for="state">State:</label></td>
						<td><input type="text" id="state" name="state" placeholder="ST"></td>
					</tr>
					<tr>
						<td class="tag"><label for="zip">Zip:</label></td>
						<td><input type="text" id="zip" name="zip" placeholder="Zip" <?php if(!fIsValidZipCode($zip) && isset($_POST['valid'])){ echo "class=errorMsg"; } ?>><?php if(!fIsValidZipCode($zip) && isset($_POST['valid'])){ echo "Not a valid zipcode"; } ?></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" id="valid" name="valid" value="submit"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" id="notvalid" name="notvalid" value="Submit without HTML5 validation" formnovalidate></td>
					</tr>
				</table>
			</form>
			<?php fIsValidRange($age); ?>
		</div>
	</body>
</html>