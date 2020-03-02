<!doctype HTML>
	<head>
	<meta charset="utf-8" lang="en">
	<link rel="stylesheet" type="text/css" href="checker.css">
		<title></title>
	</head>
	<body>
	<!--Question 1-->
	<?php
		function isBitten(){
			$value = rand(0,1);
			if($value == 0){
				return false;
			} else{
				return true;
			}
		}
		if(isBitten()){
			?> <h3>Charlie ate my lunch!</h3><?php
		}
		else{
			?> <h3>Charlie did not eat my lunch!</h3><?php
		}
	?>
	<!--End Question 1-->
	
	<!--Question 2-->
	<h3>Checkerboard</h3>
	<table class="checkerboard">
	<?php
		$row=8;
		$column=8;
		for($i=1; $i<=$row; $i++){
			echo "<tr>";
			for($j=1; $j<=$column; $j++){
				if(($i+$j)%2 == 0){
					echo '<td class="checkerslot red"></td>';
				} else{
					echo '<td class="checkerslot black"></td>';
				}
			}
			echo "</tr>";
		}
	
	?>
	</table>
	<!--End Question 2-->
	
	<!--Question 3-->
	<h3>Sorted with function</h3>
	<?php
		$month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		function sortAlpha(){
			global $month;
			sort($month);
			for($i=0; $i<count($month); $i++){
				echo $month[$i] . ' ';
			}
		}
		sortAlpha();
		?>
		<h3>This is sorted with foreach loop</h3>
		<?php
		foreach($month as $array){
			echo $array . ' ';
		}
	?>
	<!--End Question 3-->
	<!--Question 4-->
	<?php
		function sortByPrice(){
			global $restaurantArray;
			for($i=0; $i<count($restaurantArray); $i++){
				$min = $i;
				for($j=$i+1; $j<count($restaurantArray); $j++){
					if($restaurantArray[$min][1] > $restaurantArray[$j][1]){
						$min = $j;
					}
				}
					$placeholder1=$restaurantArray[$i][0];
					$placeholder2=$restaurantArray[$i][1];
					//Swapping Array Address
					$restaurantArray[$i][0] = $restaurantArray[$min][0];
					$restaurantArray[$i][1] = $restaurantArray[$min][1];
					$restaurantArray[$min][0] = $placeholder1;
					$restaurantArray[$min][1] = $placeholder2;
			}
		}
		
		function sortByName(){
			global $restaurantArray;
			for($i=0; $i<count($restaurantArray); $i++){
				$min = $i;
				for($j=$i+1; $j<count($restaurantArray); $j++){
					if($restaurantArray[$min][0] > $restaurantArray[$j][0]){
						$min = $j;
					}
				}
				$placeholder1=$restaurantArray[$i][0];
				$placeholder2=$restaurantArray[$i][1];
				//Swapping Array Address
				$restaurantArray[$i][0] = $restaurantArray[$min][0];
				$restaurantArray[$i][1] = $restaurantArray[$min][1];
				$restaurantArray[$min][0] = $placeholder1;
				$restaurantArray[$min][1] = $placeholder2;
			}
		}
	?>
	<p>
	<form action="hw2.php" method="post">
		<input type="submit" name="sort" value="Name">
		<input type="submit" name="sort" value="Value">
		<input type="submit" name="sort" value="Default">
	</form>
	</p>
	<h3>This is sorted with <?= $_POST['sort']; ?></h3>
	<?php
		$restaurantArray = array
			(
			array("Chama Gaucha","$40.50"),
			array("Aviva by Kameel","$15.00"),
			array("Bone's Restaurant","$65.00"),
			array("Umi Sushi Buckhead","$40.50"),
			array("Fandangles","$30.00"),
			array("Capital Grille","$60.50"),
			array("Canoe","$35.50"),
			array("One Flew South","$21.00"),
			array("Fox Bros. BBQ","$15.00"),
			array("South City Kitchen Midtown","$29.00")
			);
		$restaurantArraySave = $restaurantArray;
		if(isset($_POST['sort'])){
			$sort=$_POST['sort'];
			if($sort == "Name"){
				sortByName();
			}
			else if($sort == "Value"){
				sortbyPrice();
			}
			else if($sort == "Default"){
				$restaurantArray = $restaurantArraySave;
			}
			
		}?><p><table><?php
		for($i=0; $i<count($restaurantArray); $i++){
			echo '<tr>';
			for($j=0; $j<2; $j++){
				echo "<td>".$restaurantArray[$i][$j]."</td>";
			}
			echo '</tr>';
		}
	?>
	</table>
	</p>
	<!--End Question 4-->
	<!--Question 5-->	
	<h3>Place an order!</h3>
	<form action="hw2.php" method="post">
		<label for="hamburger">How Many Hamburgers?</label>
		<input type="number" id="hamburger" name="hamburger" min="0">
		<br />
		<label for="chocolate milkshake">How Many Chocolate Milkshakes?</label>
		<input type="number" id="chocolate milkshake" name="milkshake" min="0">
		<br />
		<label for="cola">How Many Colas?</label>
		<input type="number" id="cola" name="cola" min="0">
		<br />
		<input type="submit" name="submit">
	</form>
	<?php
		$hamburgercost = 4.95;
		$chocolatemilkshakecost = 1.95;
		$colacost = .85;
		$sales_tax = .075;		//7.5%
		$tip = .16;			//16%
		
		if(isset($_POST['submit'])){
			$hamburgeramt = $_POST['hamburger'];
			$chocolatemilkshakeamt = $_POST['milkshake'];
			$colaamt = $_POST['cola'];
		}
		$totalhamburgercost=$hamburgeramt*$hamburgercost;
		$totalchocolatemilkshakecost=$chocolatemilkshakeamt*$chocolatemilkshakecost;
		$totalcolacost=$colaamt*$colacost;
		$totalcost =$totalhamburgercost + $totalchocolatemilkshakecost + $totalcolacost;
		$totalsalescost = ($totalcost*$sales_tax) + ($totalcost*$tip) + $totalcost
		?>
		<p>The total cost is: <?= round($totalsalescost, 2) ?></p>

	<!--End Question 5-->
	</body>
</html>