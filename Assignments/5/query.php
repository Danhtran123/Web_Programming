<?php
$servername = "localhost";
$username = "dtran54";
$password = "dtran54";
$dbname = "dtran54";
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
	echo "Connection Failed: " . $conn->connect_error;
}
$supplierID = $_POST["sid"];
$query = "SELECT Date_Of_Purchase, Description, Price FROM Purchases WHERE Supplier_ID = '$supplierID'";
?>
<!DOCTYPE html>
	<head>
	<link rel="stylesheet" type="text/css" href="index.css"></link>
	<title></title>
	</head>
	<body>
		<div class="menu">
			<a class="menu-item" href="index.html">Homepage</a>
			<a class="menu-item" href="display.php">Show orders</a>
			<a class="menu-item" href="newpurchase.html">Make an order</a>
			<a class="menu-item" href="query.html">Find a supplier</a>
		</div>
	<br/><br/><br/>
	<?php
$result = $conn->query($query);
if($result->num_rows>0){
	echo '<table style="margin:auto;border:1px solid black;border-collapse:collapse;" border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td class="tdphp"> Date_Of_Purchases </td> 
          <td class="tdphp"> Description </td> 
		  <td class="tdphp"> Price </td> 
      </tr>';
	while($row = $result->fetch_assoc()){
		$Date_Of_Purchases = $row["Date_Of_Purchase"];
		$Description = $row["Description"];
		$Price = $row["Price"];
		
		echo '<tr> 
                  <td class="tdphp">'.$Date_Of_Purchases.'</td> 
                  <td class="tdphp">'.$Description.'</td> 
				  <td class="tdphp">'.$Price.'</td>
              </tr>';
	}
}
else{
	echo "No Searches Found";
}
		?>
	</body>
</html>