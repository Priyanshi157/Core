<?php
require_once("Model/Core/Adapter.php");
//$adapter = new Model_Core_Adapter();
class Controller_Customer
{
	public function gridAction()
	{
		require_once('view/customer/grid.php');
	}

	public function addAction()
	{
		require_once('view/customer/add.php');
	}

	public function editAction()
	{
		require_once('view/customer/edit.php');
	}

	public function deleteAction()
	{
		try 
		{
			if(!isset($_GET['id']))
			{
				throw new Exception("Invalid Request", 1);
			}	
			$adapter = new Model_Core_Adapter();
			$customerid = $_GET['id'];
			$result = $adapter->delete("DELETE FROM `customer` WHERE `customerId` = '$customerid'");
			if(!$result)
			{
				throw new Exception("System is unable to delete record.", 1);
			}
			$this->redirect("index.php?c=customer&a=grid");
		}
		catch (Exception $e) 
		{
			$this->redirect("index.php?c=customer&a=grid");	
		}	
	}

	protected function saveCustomer()
	{
		if(!isset($_POST['customer']))
		{
			throw new Exception("Invalid Request", 1);
		}

		$adapter = new Model_Core_Adapter();
		$row = $_POST['customer'];
		$firstName = $row["firstName"];
	    $lastName = $row["lastName"];
		$email = $row["email"];
		$mobile = $row["mobile"];
		$status = $row["status"];
		$createdAt = date('Y-m-d H:i:s');
		$updatedAt = date('Y-m-d H:i:s');
		if (array_key_exists('customerId',$row))
		{
			if(!(int)$row['customerId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$customerId = $row["customerId"];

			$query = "UPDATE customer 
				SET firstName='$firstName',
					lastName='$lastName',
					email='$email',
					mobile='$mobile',
					status='$status',
					updatedAt='$updatedAt'
				WHERE customerId= '$customerId'";

			$update = $adapter->update($query);
			if(!$update)
			{
				throw new Exception("System is unable to update.");
			}
		}
		else
		{
			$customerId = $adapter->insert("INSERT INTO `customer` (`firstName`,`lastName`,`email`,`mobile`,`status`,`createdAt`,`updatedAt`) 
							VALUES ('$firstName','$lastName','$email','$mobile','$status','$createdAt','$updatedAt')");

			if(!$customerId)
			{
				throw new Exception("Invalid insert Request", 1);
			}
		}
		return $customerId;
	}

	public function saveAddress($customerId)
	{
		if(!isset($_POST['customerAddress']))
		{
			throw new Exception("Missing address data in request.", 1);
		}
		$adapter = new Model_Core_Adapter();
		$row = $_POST['customerAddress'];
		$address = $row["address"];
		$postalCode = $row["postalCode"];
		$city = $row["city"];
		$state = $row["state"];
		$country = $row["country"];		
		$billing = 0;
		if(array_key_exists('billing',$row) && $row["billing"] == 1){
			$billing = 1;
		}
		$shiping = 0;
		if(array_key_exists('shiping',$row) && $row["shiping"] == 1){
			$shiping = 1;
		}

		$addressData = $adapter->fetchRow("SELECT * FROM address WHERE customerId = $customerId");
		if($addressData)
		{
			$addressQuery = "UPDATE address 
							SET address='$address',
							    postalCode='$postalCode',
							    city='$city',
							    state='$state',
							    country='$country',
							    billing='$billing',
							    shiping='$shiping'
							WHERE customerId= '$customerId'";

			$updateAddress = $adapter->update($addressQuery);
			if(!$updateAddress)
			{
				throw new Exception("System is unable to update.");
			}
		}
		else
		{
			$insert = $adapter->insert("INSERT INTO `address` (`customerId`,`address`,`postalCode`,`city`,`state`,`country`,`billing`,`shiping`) 
							VALUES ('$customerId','$address','$postalCode','$city','$state','$country','$billing','$shiping')");

			if(!$insert)
			{
				throw new Exception("System is unable to insert record.", 1);
			}	
		}
	}

	public function saveAction()
	{
		try
		{
			$customerId = $this->saveCustomer();
			$this->saveAddress($customerId);
			
			$this->redirect('index.php?c=customer&a=grid');
		} 
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=customer&a=grid');
		}
	}

	public function redirect($url)
	{
		header("location: $url");
		exit();
	}

	public function errorAction()
	{
		echo "error";
	}
}
?>