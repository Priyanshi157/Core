<?php require_once('Adapter.php');  ?>
<?php 

class Customer
{
	public function gridAction()
	{
		require_once('customer_grid.php');
	}

	public function addAction()
	{
		require_once('customer_add.php');
	}

	public function editAction()
	{
		require_once('customer_edit.php');
	}

	public function deleteAction()
	{
		global $adapter; 
		if($customerid = $_GET["id"])
		{			
		    $result = $adapter->delete("DELETE FROM customer WHERE customerId='$customerid'");
		    if($result)
		    {
		        header('location:customer.php?a=gridAction');
		    }
		}
		else
		{
			echo "No id found!";
		}	
	}

	public function saveAction()
	{
		global $adapter;
		if (!$_GET["id"])
		{
		    $firstName = $_POST["firstName"];
		    $lastName = $_POST["lastName"];
			$email = $_POST["email"];
			$mobile = $_POST["mobile"];
			$status = $_POST["status"];
			$createdAt = date('Y-m-d H:i:s');
			$updatedAt = date('Y-m-d H:i:s');

			$adapter->insert("INSERT INTO `customer` (`firstName`,`lastName`,`email`,`mobile`,`status`,`createdAt`,`updatedAt`) 
							VALUES ('$firstName','$lastName','$email','$mobile','$status','$createdAt','$updatedAt')");
			
		}

		//for data update
		if($_GET["id"])
		{
			$customerid = $_POST["customerid"];
		    $firstName = $_POST["firstName"];
		    $lastName = $_POST["lastName"];
			$email = $_POST["email"];
			$mobile = $_POST["mobile"];
			$status = $_POST["status"];
			$createdAt = date('Y-m-d H:i:s');
			$updatedAt = date('Y-m-d H:i:s');

			$adapter->update("UPDATE customer SET firstName = '$firstName' , lastName = '$lastName' , email = '$email' , mobile = '$mobile' , status = '$status' , updatedAt = '$updatedAt' WHERE customerId=$customerid");
		}

		header('location:customer.php?a=gridAction');
	}

	public function errorAction()
	{
		echo "error";
	}
}

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$customer = new Customer();
$customer->$action();

?>