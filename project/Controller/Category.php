<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php Ccc::loadClass('Model_Category'); ?>
<?php 

class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Category_Grid')->toHtml();
	}
	
	public function addAction()
	{
		Ccc::getBlock('Category_Add')->toHtml();
	}

	public function editAction()
	{
		$categoryModel = Ccc::getModel('Category');
		$request = $this->getRequest();
		$adapter = new Model_Core_Adapter();
		try 
		{
			$cid = (int)$request->getRequest('id');
			if(!$cid)
			{
				throw new Exception("Invalid Request.", 1);
			}
			$category = $categoryModel->fetchRow("SELECT * FROM category WHERE categoryId = '$cid'");
			$categoryPath = $adapter->fetchPairs("SELECT categoryId, categoryPath FROM category WHERE categoryPath NOT LIKE '%$cid%'");
			if(!$category)
			{
				throw new Exception("System is unable to find record.", 1);
						
			}
			Ccc::getBlock('Category_Edit')->addData('category',$category)->addData('categoryPath',$categoryPath)->toHtml();
		}
		catch (Exception $e) 
		{
			throw new Exception("System is unable to fetch.", 1);	
		}
	}

	public function updatePath($categoryId,$parentId)
	{
		$adapter = new Model_Core_Adapter();
		$date = date('Y-m-d H:m:s');
	
		$category = $adapter->fetchRow("SELECT * FROM category WHERE categoryId = '$categoryId' ");
		
		print_r($path = $category['categoryPath']);
		$categoryPath = $adapter->fetchAll("SELECT * FROM category WHERE categoryPath LIKE '$path%' ORDER BY categoryPath ");
		if($parentId == 'NULL')
		{
			$query = "UPDATE category SET parentId=null , categoryPath = '$categoryId' WHERE categoryId = '$categoryId'";
		}
		else
		{
			$parent = $adapter->fetchRow("SELECT * FROM category WHERE categoryId = '$parentId'");
			print_r($parentPath = $parent['categoryPath']);
			$query = "UPDATE category SET parentId = '$parentId' , categoryPath = '$parentPath' WHERE categoryId = '$categoryId'";
		}

		$update = $adapter->update($query);
		if(!$update)
		{
			throw new Exception("System is unable to update.", 1);
		}

		foreach ($categoryPath as $row) 
		{
			$parent = $adapter->fetchRow("SELECT * FROM category WHERE categoryId = '$row[parentId]'");
			//print_r($parent);
			$newPath = $parent['categoryPath'].'/'.$row['categoryId'];
			print_r($newPath);
			//echo "<br>";
			//exit;

			$query = "UPDATE category SET categoryPath = '$newPath', updatedAt = '$date' WHERE categoryId = '$row[categoryId]'";
			$update = $adapter->update($query);
			if(!$update)
			{
				throw new Exception("System is unable to update.", 1);
			}
			//$this->redirect("index.php?c=category&a=grid");
		}
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
			$categoryId = $request->getRequest('id');
			$result = $adminModel->delete($categoryId);
			if(!$result)
			{
				throw new Exception("System is unable to delete record.", 1);
			}
			$this->redirect($this->getView()->getUrl('category','grid',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('category','grid',[],true));
		}
	}

	public function saveAction()
	{
        try 
        {
            $request = $this->getRequest();
            $postData = $request->getPost('category');
            if(!$postData)
            {
                throw new Exception("Request Invalid.",1);
            }
            
            global $adapter;
            $name = $postData['name'];
            $parentId = $postData['parentId'];
            $status = $postData['status'];
            $createdAt = date('y-m-d h:m:s');
            $updatedAt = date('y-m-d h:m:s');
            if(array_key_exists('categoryId', $postData))
            {
                $categoryId = $_GET['id'];
                if(!(int)$categoryId)
                {
                    throw new Exception("Invalid Request.", 1);
                }
                $parent = $postData['root'];

                $data = $adapter->update("UPDATE category SET name ='$name', status ='$status', updatedAt ='$updatedAt' where categoryId = $categoryId");


                if(empty($parent))
                {
                    $path = $adapter->update("UPDATE category SET parentId = NULL,`categoryPath`='$categoryId' WHERE categoryId = '$categoryId'");

                    $parentId = $postData['parentId'];

                    $data = $adapter->fetchAll("SELECT * FROM category WHERE `categoryPath` LIKE '%$categoryId%'");

                    foreach($data as $allData)
                    {
                        $path = $allData['categoryPath'];
                        if($allData['categoryId']!=$categoryId)
                        {
                            $currentId = $allData['categoryId'];
                            $updatePath = ltrim($path , $parentId);
                            $finalPath = ltrim($updatePath , '/');
                            $parentId = $allData['parentId'];
                                        
                            $path = $adapter->update("UPDATE category SET parentId=$parentId,`categoryPath`='$finalPath' WHERE categoryId='$currentId'");
                        }
                    }
                }
                else
                {
                    $parentId = $postData['parentId'];

                    $row = $adapter->fetchAssos("SELECT * FROM category WHERE categoryId='$parent'");
                    $parentPath = $row['categoryPath'];

                    $query = $adapter->fetchAssos("SELECT * FROM category where categoryId='$categoryId'");
                    $currentpath = $query['categoryPath'];

                    $possiblePath = $adapter->fetchAll("SELECT * from category where `categoryPath` LIKE '$currentpath%'");

                    foreach($possiblePath as $allPath)
                    {
                        $currentId = $allData['categoryId'];
                        $path = $allPath['categoryPath'];

                        $updatePath = ltrim($path , $parentId);
                        $updatePath = ltrim($updatePath , '/');

                        $updatePath = explode('/', $updatePath);

                                
                        foreach ($updatePath as $value) {
                            if($value==$categoryId){
                                break;
                            }
                            array_shift($updatePath);
                        }
                        
                        $path = implode('/', $updatePath);

                        if($allPath['categoryId']!=$categoryId)
                        {
                            $parent = $allPath['parentId']; 
                            $FinalUpdate = $parentPath.'/'.$path; 
                            $currentId = $allPath['categoryId']; 
                        }
                        else
                        {
                            $parent = $parentPath; 
                            $FinalUpdate = $parentPath.'/'.$path; 
                            $currentId = $allPath['categoryId']; 
                        }

                        $path = $adapter->update("UPDATE category SET parentId='$parent',`categoryPath` = '$FinalUpdate' WHERE categoryId = '$currentId'");
                    }
                    if(!$path)
                    {
                        
                        throw new Exception("Data Not Upadated", 1);
                    }
                }
                    $this->redirect($this->getView()->getUrl('category','grid'));
            }
            else
            {
                if(empty($parentId))
                {
                    $result = $adapter->insert("INSERT INTO `category` (`name`,`status`,`createdAt`) VALUE ('$name','$status','$createdAt')");
                    if(!$result)
                    {
                        throw new Exception("System is unabel to insert data", 1);                          
                    }
                    $path = $adapter->update("UPDATE `category` SET `categoryPath` = '$result' WHERE `categoryId` = '$result' ");
                }
                
                else
                {
                    $result = $adapter->insert("INSERT INTO `category` (`parentId`,`name`,`status`,`createdAt`) VALUE ('$parentId','$name','$status','$createdAt')");
                    if(!$result)
                    {
                        throw new Exception("System is unabel to insert data", 1);                          
                    }
                    $path = $adapter->fetchRow("SELECT * FROM `category` WHERE `categoryId` = '$parentId' ");
                    $path = $path['categoryPath']."/".$result;
                    $newPath = $adapter->update("UPDATE `category` SET `categoryPath` = '$path' WHERE `categoryId` = '$result' ");
                }
                if(!$result)
                {
                    throw new Exception("Sysetm is unable to save your data", 1);   
                }
                 $this->redirect($this->getView()->getUrl('category','grid'));
            }
        } 
        catch (Exception $e) 
        {
            $this->redirect($this->getView()->getUrl('category','grid'));
        }
    }
}


?>