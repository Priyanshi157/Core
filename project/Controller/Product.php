<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 

class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		$adapter = new Model_Core_Adapter();
		$products = $adapter->fetchAll("SELECT * FROM product");
		$view = $this->getView();
		$view->setTemplate('view/product/grid.php');
		$view->addData('products',$products);
		$view->toHtml();
	}

	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/product/add.php');
		$view->toHtml();
	}

	public function editAction()
	{
		global $c;
		$request = $c->getFront()->getRequest();
		$adapter = new Model_Core_Adapter();
		$pid = $request->getRequest('id');
		$product = $adapter->fetchRow("SELECT * FROM product WHERE productId = $pid");
		$view = $this->getView();
		$view->setTemplate('view/product/edit.php');
		$view->addData('product',$product);
		$view->toHtml();
	}

	public function deleteAction()
	{
		try 
		{
			global $c;
			$request = $c->getFront()->getRequest();
			if(!$request->getRequest('id'))
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
			global $c;
			$post = $c->getFront()->getRequest();
			$post->getPost();
			if(!$post->getPost('product'))
			{
				throw new Exception("Invalid Request", 1);
			}	
			global $adapter;
			$row = $post->getPost('product');
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

?>