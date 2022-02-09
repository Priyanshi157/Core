<?php require_once("Model/Core/Adapter.php");  ?>
<?php 

class Controller_Product
{
	public function gridAction()
	{
		require_once('view/product/grid.php');
	}

	public function addAction()
	{
		require_once('view/product/add.php');
	}

	public function editAction()
	{
		require_once('view/product/edit.php');
	}

	public function deleteAction()
	{
		try 
		{
			if(!isset($_GET['id']))
			{
				throw new Exception("Invalid Request.", 1);
			}
			global $adapter;
			$productid = $_GET["id"];
		    $result = $adapter->delete("DELETE FROM product WHERE productId='$productid'");
		    if($result)
		    {
		        throw new Exception("System is unable to delete record.", 1);
		    }
		    $this->redirect('index.php?c=product&a=grid');
		} 
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=product&a=grid');
		}		
	}

	public function saveAction()
	{
		try 
		{
			if(!isset($_POST['product']))
			{
				throw new Exception("Invalid Request", 1);
			}	
			global $adapter;
			$row = $_POST['product'];
			$name = $row["name"];
			$price = $row["price"];
			$quantity = $row["quantity"];
			$status = $row["status"];
			$createdAt = date('Y-m-d H:i:s');
			$updatedAt = date('Y-m-d H:i:s');

			if (array_key_exists('productId',$row))
			{
				if(!(int)$row['productId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$productid = $row["productId"];
				$update = $adapter->update("UPDATE product 
											SET name = '$name' , 
												price = '$price' , 
												quantity = '$quantity' , 
												status = '$status' , 
												updatedAt = '$updatedAt' 
											WHERE productId=$productid");

				if(!$update)
				{
					throw new Exception("System is unable to update.");
				}
			}
			else
			{
				$insert = $adapter->insert("INSERT INTO `product` (`name`,`price`,`quantity`,`status`,`createdAt`,`updatedAt`) 
											VALUES ('$name','$price','$quantity','$status','$createdAt','$updatedAt')");
				if(!$insert)
				{
					throw new Exception("System is unable to insert record.", 1);
				}
			}
			$this->redirect('index.php?c=product&a=grid');
		} 
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=product&a=grid');	
		}
	}


	public function redirect($url)
	{
		header("location:$url");
	}

	public function errorAction()
	{
		echo "error";
	}
}

// $action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
// $product = new Product();
// $product->$action();

?>