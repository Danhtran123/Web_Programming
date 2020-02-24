<!DOCTYPE html>
	<head>
		<title>
		</title>
	</head>
	<body>
		<p style="font-style:italic">"Good morning, Dave," said HAL</p>
		<?php 
		$radius = 5;
		$area = pi() * pow($radius,2);
		?>
		<p>Area is <?= $area ?></p>
		
		<?php
		$Fahrenheit = 90;
		$celFahr = (5/9)*($Fahrenheit-32);
		?>
		<p>Fahrenheit is <?= $Fahrenheit ?> while celsius is <?= $celFahr?></p>

		<?php
		$statement = "   PHP is fun   ";
		$cleanStatement = trim($statement);
		$x = strlen($cleanStatement);
		?>
		<p>String has <?= $x ?> characters</p>
		
		<?php
		$statement1 = "WDWWLWWWLDDWDLL";
		$statement2 = strpos($statement1,"WWW");
		$statement3 = substr($statement1, $statement2+3, 1);
		?>
		<p>The first letter after the first occurence of WWW is <?= $statement3 ?></p>
		
		<?php
		$statementO = "Able was I ere I saw Elba";
		$statementO = strtolower($statementO);
		for($i=strlen($statementO)-1; $i>=0; $i--){
			$statementRev = $statementRev . $statementO[$i];
		}
		if(strcmp($statementO, $statementRev)==0){
			$statementFact = "true";
		} else {
			$statementFact = "false";
		}
		?>
		<p>Is the string "<?= $statementO ?>" a palindrome? <?= $statementFact ?></p>
		
		<?php
		(int)$num = 78;
		$fact;
		if($num % 2 == 0){
			$fact = "even";
		} else{
			$fact = "odd";
		}
		?>
		<p>The number <?= $num ?> is <?= $fact ?></p>
		
		<?php
		$leapCheck = date('L');
		if($leapCheck == 1){
			$leap = "leap year";
		} else{
			$leap = "regular year";
		}
		?>
		<p style="font-weight:bold">The year <?= date(Y) ?> is a <?= $leap ?></p>
	</body>
</html>