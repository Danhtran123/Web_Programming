<?php
$servername = "localhost";
$username = "dtran54";
$password = "dtran54";
$dbname = "dtran54";
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
	echo "Connection Failed: " . $conn->connect_error;
}
?>
<!doctype HTML>
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
	<h2>NIKE</h2>
	<p>Order List</p>
	<?php
echo '<table style="margin:auto;border:1px solid black;border-collapse:collapse;" border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td class="tdphp"> Purchase_No </td> 
          <td class="tdphp"> SupplierID </td> 
          <td class="tdphp"> Date_Of_Purchases </td> 
          <td class="tdphp"> Quantity </td> 
          <td class="tdphp"> Description </td> 
		  <td class="tdphp"> Price </td> 
      </tr>';
$query = "SELECT * FROM Purchases";
if($result = $conn->query($query)){
	while($row = $result->fetch_assoc()){
		$Purchase_No = $row["Purchase_No"];
		$SupplierID = $row["Supplier_ID"];
		$Date_Of_Purchases = $row["Date_Of_Purchase"];
		$Quantity = $row["Quantity"];
		$Description = $row["Description"];
		$Price = $row["Price"];
		
		echo '<tr> 
                  <td class="tdphp">'.$Purchase_No.'</td> 
                  <td class="tdphp">'.$SupplierID.'</td> 
                  <td class="tdphp">'.$Date_Of_Purchases.'</td> 
                  <td class="tdphp">'.$Quantity.'</td> 
                  <td class="tdphp">'.$Description.'</td> 
				  <td class="tdphp">'.$Price.'</td>
              </tr>';
	}
}
echo "</table>";
$conn->close();
echo $msg;
?>
	</body>
</html>