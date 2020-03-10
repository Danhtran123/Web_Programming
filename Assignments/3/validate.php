<!DOCTYPE html>
	<head>
		<style>
			.tag{
				text-align: right;
			}
			.container{
				display: flex;
				justify-content: center;
			}
		</style>
	<title></title>
	</head>
	<body>
		<div class="container">
			<form style="text align: center;" action="validate.php" method="POST">
				<table>
					<tr>
						<td class="tag"><label for="email">Email:</label></td>
						<td><input type="email" id="email" name="email" placeholder="Email" required"></td>
					</tr>
					<tr>
						<td class="tag"><label for="fname">First name:</label></td>
						<td><input type="text" id="fname" name="fname" placeholder="First name" required></td>
					</tr>
					<tr>
						<td class="tag"><label for="birthday">Birthday:</label></td>
						<td><input type="date" id="birthday" name="birthday" required> <br /></td>
					</tr>
					<tr>
						<td class="tag"><label for="age">Age:</label></td>
						<td><input type="text" id="age" name="age" placeholder="age" required pattern="[0-9]*"></td>
					</tr>
					<tr>
						<td class="tag"><label for="state">State:</label></td>
						<td><input type="text" id="state" name="state" placeholder="ST" required pattern="[A-Za-z]{2}"></td>
					</tr>
					<tr>
						<td class="tag"><label for="zip">Zip:</label></td>
						<td><input type="text" id="zip" name="zip" placeholder="Zip" required pattern="[0-9]{5}"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" id="valid" name="valid" value="Submit form"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" id="notvalid" name="notvalid" value="Submit without HTML5 validation" formnovalidate></td>
					</tr>
				</table>
			</form>
			
			<?php 
				if(isset($_POST['notvalid'])){
					if($_POST['email'] != null){
						echo "Email: " . $_POST['email'] . "<br />";
					}
					if($_POST['fname'] != null){
						echo "First Name: " . $_POST['fname'] . "<br />";
					}
					if($_POST['birthday'] != null){
						echo "Birthday: " . $_POST['birthday'] . "<br />";
					}
					if($_POST['age'] != null){
						echo "age: " . $_POST['age'] . "<br />";
					}
					if($_POST['state'] != null){
						echo "state: " . $_POST['state'] . "<br />";
					}
					if($_POST['zip'] != null){
						echo "Zip: " . $_POST['zip'] . "<br />";
					}
					
				}
			?>
		</div>
</html>