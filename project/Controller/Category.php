<?php require_once("Model/Core/Adapter.php");  ?>
<?php 

class Controller_Category
{
	public function gridAction()
	{
		require_once('view/category/grid.php');
	}

	public function addAction()
	{
		require_once('view/category/add.php');
	}

	public function editAction()
	{
		require_once('view/category/edit.php');
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
			$categoryid = $_GET["id"];
			$result = $adapter->delete("DELETE FROM category WHERE categoryId=$categoryid");
			if(!$result)
			{
				throw new Exception("System is unable to delete record.", 1);
			}
			$this->redirect('index.php?c=category&a=grid');
		} 
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=category&a=grid');
		}
	}

	public function saveAction()
	{
		try 
		{
			if(!isset($_POST['category']))
			{
				throw new Exception("Invalid Request", 1);
			}	
			global $adapter;
			$row = $_POST['category'];
			$name = $row["name"];
			$status = $row["status"];
			$createdAt = date('Y-m-d H:i:s');
			$updatedAt = date('Y-m-d H:i:s');

			if (array_key_exists('categoryId',$row))
			{
				if(!(int)$row['categoryId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$categoryid = $row["categoryId"];
				$update = $adapter->update("UPDATE category 
											SET name = '$name' , 
												status = '$status' , 
												updatedAt = '$updatedAt'
											WHERE categoryid='$categoryid'");

				if(!$update)
				{
					throw new Exception("System is unable to update.");
				}
			}
			else
			{
				$insert = $adapter->insert("INSERT INTO `category` (`name`,`status`,`createdAt`,`updatedAt`) 
							VALUES ('$name','$status','$createdAt','$updatedAt')");
				if(!$insert)
				{
					throw new Exception("System is unable to insert record.", 1);
				}
			}
			$this->redirect('index.php?c=category&a=grid');
		} 
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=category&a=grid');
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
// $category = new Controller_Category();
// $category->$action();

?>