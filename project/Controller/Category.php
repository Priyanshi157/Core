<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Core_Request'); ?>
<?php  ?>
<?php 

class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		//$adapter = new Model_Core_Adapter();
		$categoryModel = Ccc::getModel('Category');
		$categories = $categoryModel->fetchAll("SELECT * FROM category ORDER BY categoryPath ASC");
		$view = $this->getView();
		$view->setTemplate('view/category/grid.php');
		$view->addData('categories',$categories);
		$view->toHtml();
	}
	
	public function addAction()
	{
		$view = $this->getView();
		$view->setTemplate('view/category/add.php');
		$view->toHtml();
	}

	public function editAction()
	{
		$categoryModel = Ccc::getModel('Category');
		$request = $this->getRequest();
		$adapter = new Model_Core_Adapter();
		try 
		{
			$cid = $request->getRequest('id');
			if(!$cid)
			{
				throw new Exception("Invalid Request.", 1);
			}
			$category = $adapter->fetchRow("SELECT * FROM category WHERE categoryId = '$cid'");
			$categoryPath = $adapter->fetchPairs("SELECT categoryId, categoryPath FROM category WHERE categoryPath NOT LIKE '%$cid%'");
			if(count($category) > 0)
			{
				$cname = $category['name'];
				$status = $category['status'];
			}
		} 
		catch (Exception $e) 
		{
			throw new Exception("System is unable to fetch.", 1);	
		}

		$view = $this->getView();
		$view->setTemplate('view/category/edit.php');
		$view->addData('categoryPath',$categoryPath);
		$view->addData('category',$category);
		$view->toHtml();
	}

	public function updatePath($categoryId,$parentId)
	{
		$adapter = new Model_Core_Adapter();
		$date = date('Y-m-d H:m:s');
		

		$category = $adapter->fetchRow("SELECT * FROM category WHERE categoryId = '$categoryId' ");
		
		$path = $category['categoryPath'];
		$categoryPath = $adapter->fetchAll("SELECT * FROM category WHERE categoryPath LIKE '$path%' ");
		if($parentId == 'NULL')
		{
			$query = "UPDATE category SET parentId=null , categoryPath = '$categoryId' WHERE categoryId = '$categoryId'";
		}
		else
		{
			$parent = $adapter->fetchRow("SELECT * FROM category WHERE categoryId = '$parentId'");
			$parentpath = $parent['categoryPath'];
			$query = "UPDATE category SET parentId = '$parentId' , categoryPath = '$parentPath' WHERE categoryId = '$categoryId'";
		}

		$updte = $adapter->update($query);
		if($update)
		{
			echo "error";
			exit;
			throw new Exception("System is unable to update!!", 1);
		}

		foreach ($categoryPath as $row) 
		{
			$parent = $adapter->fetchRow("SELECT * FROM category WHERE categoryId = '$row[parentId]'");
			$newPath = $parent['categoryPath'].'/'.$row['categoryId'];

			$query = "UPDATE category SET categoryPath = '$newPath', updatedAt = '$date' WHERE categoryId = '$row[categoryId]'";
			$update = $adapter->update($query);
			if(!$update)
			{
				throw new Exception("System is unable to update!", 1);
			}
			$this->redirect("index.php?c=category&a=grid");
		}
	}

	public function getDataByPath()
    {
        $adapter = new Model_Core_Adapter();

        $category = [];
        $categoryIdName = $adapter->fetchPairs('SELECT categoryId , name FROM category ORDER BY categoryPath ASC');
        $categoryIdPath = $adapter->fetchPairs('SELECT categoryId , categoryPath FROM category ORDER BY categoryPath ASC');
        foreach ($categoryIdPath as $categoryId => $path) 
        {
            $idArray = explode("/", $path);
            $temp=[];
            foreach($idArray as $key => $Id)
            {
                if(array_key_exists($Id, $categoryIdName)):
                    array_push($temp ,$categoryIdName[$Id]);
                endif;
            }
            $pathArray = implode("/", $temp);
            $category[$categoryId] = $pathArray;   
        }
        return($category);
    }

	public function deleteAction()
	{
		try 
		{
			$adminModel = Ccc::getModel('category');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request", 1);
			}	
			$adapter = new Model_Core_Adapter();
			$categoryid = $request->getRequest('id');
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

		try 
		{
			$adminModel = Ccc::getModel('Admin');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}
			$adminId = $request->getRequest('id');
			$result = $adminModel->delete($adminId);
			$this->redirect($this->getView()->getUrl('admin','grid',[],true));
		} 
		catch (Exception $e) 
		{
			$this->getView()->getUrl('admin','grid',[],true);
		}

	}

	public function saveAction()
	{
		try 
		{
			// if(!isset($_POST['category']))
			if(!$this->getRequest()->getPost('category'))
			{
				throw new Exception("Invalid Request", 1);
			}	
			global $adapter;
			$row = $this->getRequest()->getPost('category');
			//$row = $this->getPost('category');
			$name = $row["name"];
			$status = $row["status"];
			$createdAt = date('Y-m-d H:i:s');
			$updatedAt = date('Y-m-d H:i:s');
			$parentId = $row["parentId"];

			if (array_key_exists('categoryId',$row))
			{
				if(!(int)$row['categoryId'])
				{
					throw new Exception("Invalid Id.", 1);
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
				$this->updatePath($categoryid,$parentId);
				
			}
			else
			{
				if($parentId == 'NULL')
				{
					$insert = $adapter->insert("INSERT INTO `category` (`name`,`status`,`createdAt`,`updatedAt`) 
							VALUES ('$name','$status','$createdAt','$updatedAt')");	
				}
				else
				{
					$insert = $adapter->insert("INSERT INTO `category` (`name`,`status`,`createdAt`,`updatedAt`,`parentId`) 
							VALUES ('$name','$status','$createdAt','$updatedAt','$parentId')");
				}
				if(!$insert)
				{
					throw new Exception("System is unable to insert record.", 1);
				}

				$path = '';

				$row=$adapter->fetchRow("SELECT * FROM category WHERE categoryId=".$insert);

				if ($row['parentId'] == NULL) {
					$path = $insert;
				}
				else{
					$result=$adapter->fetchRow("SELECT * FROM category WHERE categoryId= ".$row['parentId']);
					$path = $result['categoryPath'].'/'.$insert;

				}
				
				$query = "UPDATE category SET categoryPath = '".$path."' WHERE categoryId = ".$insert;
				$update = $adapter->update($query);
				if(!$update){
					throw new Exception("System is unable to update.", 1);
				}
			}
			$this->redirect('index.php?c=category&a=grid');
		} 
		catch (Exception $e) 
		{
			print_r($e->getMessage());
			//$this->redirect('index.php?c=category&a=grid');
		}
	}
}


?>