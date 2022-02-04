<?php require_once('Adapter.php');  ?>
<?php 

class Product
{
	public function gridAction()
	{
		require_once('product_grid.php');
	}

	public function addAction()
	{
		require_once('product_add.php');
	}

	public function editAction()
	{
		require_once('product_edit.php');
	}

	public function deleteAction()
	{
		global $adapter;
		$productid = $_GET["id"];
	    $result = $adapter->delete("DELETE FROM product WHERE productId='$productid'");
	    if($result)
	    {
	        header('location:product.php?a=gridAction');
	    }	
	}

	public function saveAction()
	{
		global $adapter;
		if (!$_GET["id"])
		{
		    $name = $_POST["name"];
			$price = $_POST["price"];
			$quantity = $_POST["quantity"];
			$status = $_POST["status"];
			$createdAt = date('Y-m-d H:i:s');
			$updatedAt = date('Y-m-d H:i:s');

			$adapter->insert("INSERT INTO `product` (`name`,`price`,`quantity`,`status`,`createdAt`,`updatedAt`) 
							VALUES ('$name','$price','$quantity','$status','$createdAt','$updatedAt')");
			
		}

		//for data update
		if($_GET["id"])
		{
			$productid = $_POST["productid"];
		    $name = $_POST["name"];
			$price = $_POST["price"];
			$quantity = $_POST["quantity"];
			$status = $_POST["status"];
			$updatedAt = date('Y-m-d H:i:s');

			$adapter->update("UPDATE product SET name = '$name' , price = '$price' , quantity = '$quantity' , status = '$status' , updatedAt = '$updatedAt' WHERE productId=$productid");
		}

		header('location:product.php?a=gridAction');
	}

	public function errorAction()
	{
		echo "error";
	}
}

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$product = new Product();
$product->$action();

?>