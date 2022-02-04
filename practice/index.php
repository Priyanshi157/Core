//CRUD using php only

<?php
echo '<pre>';

$selectQuery = "SELECT * FROM product";
$insertQuery = "INSERT INTO product(productId,name,price,quantity,status,createdAt,updatedAt) 
				VALUES ('1','Dairy Milk','10','10','1','2022-01-01','2022-02-01')";
$updateQuery = "UPDATE product SET name='DairyMilk' WHERE productId=1";
$deleteQuery = "DELETE FROM product WHERE productId=1";

class app1
{
	private $host = "localhost";
	private $user = "root";
	private $password = "root";
	private $dbname = "adapter";
	private $connection;

	public function connection()
	{
		$this->connection =mysqli_connect($this->host,$this->user,$this->password,$this->dbname);
		if($this->connection->connect_error)
		{
			echo "Not Connected to mysql".$connection->connect_error;
		}
		echo "Mysql server is connected";
		return $this->connection;
	}
	public function fetch($selectQuery)
	{
		$result = $this->connection->query($selectQuery);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc())
			{
				echo "All rows are as below <br>";
				echo $row["productId"]." " . $row["name"]." ".$row["price"]. " ".$row["quantity"]." ".$row["status"]." ".$row["createdAt"]." ".$row["updatedAt"];
			}
		}
		else
		{
			echo "0 results";
		}
	}

	public function insertData($insertQuery)
	{
		//echo $insertQuery;
		$result = mysqli_query($this->connection,$insertQuery);
		if ($result)
		{
			echo "Inserted successfully";
			return true;
		}
		else
		{
			echo mysqli_error($this->connection);
			return false;
		}
	}

	public function updateData($updateQuery)
	{
		$result = mysqli_query($this->connection,$updateQuery);
		if($result)
		{
			echo "Record updated successfully";
			return true;
		}
		else
		{
			echo "Record update failed";
			echo mysqli_error($this->connection);
			return false;
		}
	}

	public function deleteData($deleteQuery)
	{
		$result = mysqli_query($this->connection,$deleteQuery);
		if($result)
		{
			echo "Record deleted successfully";
			return true;
		}
		else{
			echo "Record delete failed";
			return false;
		}
	}
}

$obj1 = new app1();
$obj1->connection();
echo "<br><br>";
$obj1->deleteData($deleteQuery);
echo "<br><br>";
$obj1->insertData($insertQuery);
echo "<br><br>";
$obj1->fetch($selectQuery);
echo "<br><br>";
$obj1->updateData($updateQuery);
echo "<br><br>";
$obj1->fetch($selectQuery);
echo "<br><br>";
?>