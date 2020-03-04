<!doctype HTML>
	<head>
		<meta charset="utf-8" lang="en">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title></title>
		<style>
			.special{
				color: <?php echo htmlspecialchars($_POST['textcolor']); ?>;
				font-size: <?php echo htmlspecialchars($_POST['fontsize']) . px;?>;
				<?php if(isset($_POST['bold'])) echo "font-weight: bold"; ?>;
				<?php if(isset($_POST['italics'])) echo "font-style: italic"; ?>;
				<?php if(isset($_POST['underscore'])) echo "text-decoration: underline"; ?>;
			}
		</style>
	</head>
	<body>
	<p><a href="../../Assignments/1/index.html">BACK TO HOMEPAGE</a></p>
		<div>
			<form action="test.php" method="post">
				<label for="fontsize">Font:</label>
				<input type="number" id="fontsize" name="fontsize" min="8" max="24" value="<?php echo htmlspecialchars($_POST['fontsize']);?>">  <br />
				<label for="italics">Italic:</label>
				<input type="checkbox" id="italics" name="italics" <?php if(isset($_POST['italics'])) echo "checked='checked'"; ?>>
				<label for="bold">Bold:</label>
				<input type="checkbox" id="bold" name="bold" <?php if(isset($_POST['bold'])) echo "checked='checked'"; ?>>
				<label for="underscore">Underscore:</label>
				<input type="checkbox" id="underscore" name="underscore" <?php if(isset($_POST['underscore'])) echo "checked='checked'"; ?>> <br />
				<label for="textcolor">Select a Color: </label>
				<input type="color" id="textcolor" name="textcolor" value="<?php echo htmlspecialchars($_POST['textcolor']); ?>">
				<input type="submit" value="submit"> <br />
				<textarea id="testarea" rows="4" cols="50" name="testarea"><?php echo ($_POST['testarea']); ?></textarea>
			</form>
			<br />
			<textarea class="special" id="testarea" rows="4" cols="50" name="testarea"><?php echo ($_POST['testarea']); ?></textarea>
		</div>

		<br />
		<br />
		<br />
		
		<div style="text-align:center" >
			<?php
				date_default_timezone_set("EST");
				$array=[];
				$hours_to_show = 12;
				$number_of_people = 3;
				$original_hour = date("G");
				$current_hour = date("G");
				
				function get_hour_string($timestamp){
					if($timestamp>12){
						return $timestamp-12 . pm;
					}
					else{
						return $timestamp . am;
					}
				}
				echo "Date: " . date("l F j Y");
				echo " Time: " . date("G i s a");
			?>
				<table>
			<?php
				for($i=0; $i<=$hours_to_show; $i++){
					if($i%2==0){
						echo '<tr class="first">';
					}
					else if($i%2==1){
						echo '<tr class="second">';
					}
					if($current_hour > 24){
							$current_hour-=$current_hour;
					}
					array_push($array,$current_hour+$i);
					for($j=0; $j<=$number_of_people; $j++){
						if($j==0){
							if($current_hour > 12){
								echo "<td>";
								echo ($current_hour+=1)-13 . "pm";
								echo "</td>";
							}
							else{
								echo "<td>";
								echo ($current_hour+=1) . "am";
								echo "</td>";
							}
						}
						if($j!=0){
							echo "<td>Person $j Info</td>";
						}
					}
					echo "</tr>";
				}
			?>
				</table>
		</div>
		<?php
		echo get_hour_string($original_hour) . " is the first hour in the column";
		?>
	</body>
</html>