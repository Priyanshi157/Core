<?php
echo '<pre>';
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "adapter";

$connection =new mysqli($host,$user,$password,$dbname);

if($connection->connect_error){
	echo "Not Connected to mysql".$connection->connect_error;
}
else{
	echo "Mysql server is connected".$connection->connect_error;
}

echo "<br><br>";

$selectQuery = "SELECT * FROM product";
$result = $connection->query($selectQuery);

if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		echo $row["productId"]." " . $row["name"]." ".$row["quantity"]. " ".$row["price"];
	}
}
else
{
	echo "0 results";
}

echo "<br><br>";

$insertQuery = "INSERT INTO product(productId,name,quantity,price) VALUES ('1','Dairy Milk','10','10')";

if ($connection->query($insertQuery) == true)
{
	echo "New record inserted";
}
else{
	echo "Error : ". $insertQuery . "<br>" . $connection->error;
}

echo "<br><br>";
$selectQuery = "SELECT * FROM product";
$result = $connection->query($selectQuery);

if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		echo $row["productId"]." " . $row["name"]." ".$row["quantity"]. " ".$row["price"];
	}
}
else
{
	echo "0 results";
}

echo "<br><br>";

$updateQuery = "UPDATE product SET name='DairyMilk' WHERE productId=1";

if($connection->query($updateQuery) ===TRUE){
	echo "Record updated successfully";
}
else{
	echo "Record update failed";
}

echo "<br><br>";

$deleteQuery = "DELETE FROM product WHERE productId=1";

if($connection->query($deleteQuery) ===TRUE){
	echo "Record deleted successfully";
}
else{
	echo "Record delete failed";
}
echo "<br>";
?>