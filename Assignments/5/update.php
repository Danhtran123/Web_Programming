<?php
$servername = "localhost";
$username = "dtran54";
$password = "dtran54";
$dbname = "dtran54";
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
	echo "Connection Failed: " . $conn->connect_error;
}
$Purchase_No = $_POST["pnum"];
$SupplierID = $_POST["sid"];
$Date_Of_Purchase =$_POST["pdate"];
$Quantity = $_POST["quantity"];
$Description = $_POST["description"];
$Price = $_POST["price"];

$sql = "INSERT INTO Purchases (Purchase_No, Supplier_ID, Date_Of_Purchase, Quantity, Description, Price)
Values('$Purchase_No','$SupplierID','$Date_Of_Purchase','$Quantity','$Description','$Price')";

if($conn->query($sql) === TRUE){
	echo "Success";
	header("Location: display.php");
}
else{
	echo"Failure";
}
$conn->close();
?>