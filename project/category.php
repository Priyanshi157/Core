<?php require_once('Adapter.php');  ?>
<?php 

class Category
{
	public function gridAction()
	{
		require_once('category_grid.php');
	}

	public function addAction()
	{
		require_once('category_add.php');
	}

	public function editAction()
	{
		require_once('category_edit.php');
	}

	public function deleteAction()
	{
			global $adapter;
		    $categoryid = $_GET["id"];
		    print_r($categoryid);
		    $result = $adapter->delete("DELETE FROM category WHERE categoryId=$categoryid");
		    if($result)
		    {
		        header('location:category.php?a=gridAction');
		    }
		
	}

	public function saveAction()
	{
		//to insert data
		global $adapter;
		//print_r($_GET["id"]);
		//exit;
		if (!$_GET["id"])
		{
		    $name = $_POST["name"];
			$status = $_POST["status"];
			$createdAt = date('Y-m-d H:i:s');
			$updatedAt = date('Y-m-d H:i:s');

			$adapter->insert("INSERT INTO `category` (`name`,`status`,`createdAt`,`updatedAt`) 
							VALUES ('$name','$status','$createdAt','$updatedAt')");

		}

		//for data update
		if($_GET["id"])
		{
			$categoryid = $_POST["categoryid"];
		    $name = $_POST["name"];
			$status = $_POST["status"];
			$updatedAt = date('Y-m-d H:i:s');

			$adapter->update("UPDATE category SET name = '$name' , status = '$status' , updatedAt = '$updatedAt' WHERE categoryid='$categoryid'");

		}

		header('location:category.php?a=gridAction');
	}

	public function errorAction()
	{
		echo "error";
	}
}

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction';
$category = new Category();
$category->$action();

?>