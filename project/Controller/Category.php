<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 

class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Category_Grid')->toHtml();
	}
	
	public function addAction()
	{
		$categoryModel = Ccc::getModel('Category');
        $category = $categoryModel;
        Ccc::getBlock('Category_Edit')->addData('category',$category)->toHtml();
	}

	public function editAction()
	{
		$categoryModel = Ccc::getModel('Category');
		$request = $this->getRequest();
		$adapter = new Model_Core_Adapter();
		try 
		{
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request.", 1);
			}

			$category = $categoryModel->load($id);
	        
	        if(!$category)
	        {
	            throw new Exception("System is unable to find record.", 1);
	        }
        	Ccc::getBlock('Category_Edit')->addData('category',$category)->toHtml();
		}
		catch (Exception $e) 
		{
			throw new Exception("System is unable to fetch.", 1);	
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
			$result = $adminModel->load($categoryId)->delete();
			if(!$result)
			{
				throw new Exception("System is unable to delete record.", 1);
			}
			$this->redirect($this->getView()->getUrl('grid','category',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','category',[],true));
		}
	}

	public function saveAction()
    {
        try 
        {
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();
            $id = $request->getRequest('id');

            if($request->isPost())
            {
                $postData = $request->getPost('category');
                $category = $categoryModel->setData($postData);
                
                if(!empty($id))
                {
                    $category->categoryId = $id;
                    $category->updatedAt = date('y-m-d h:m:s');
                
                    if(!$postData['parentId'])
                    {
                        $category->parentId = NULL;
                    }
                    $result = $categoryModel->save();
                    if(!$result)
                    {
                        throw new Exception("Sysetm is unable to save your data", 1);   
                    }
                    
                    $allPath = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$id%' ");
                    foreach ($allPath as $path) 
                    {
                        $finalPath = explode('/',$path->path);
                        foreach ($finalPath as $subPath) 
                        {
                            if($subPath == $id)
                            {
                                if(count($finalPath) != 1)
                                {
                                    array_shift($finalPath);
                                }    
                                break;
                            }
                            array_shift($finalPath);
                        }
                        if($path->parentId)
                        {
                            $parentPath = $categoryModel->load($path->parentId);
                            $path->path = $parentPath->path ."/".implode('/',$finalPath);
                        }
                        else
                        {
                            $path->path = $path->categoryId;
                        }
                        $result = $path->save();
                    }
                }
                else
                {
                    $category->createdAt = date('y-m-d h:m:s');
                    if(!$category->parentId)
                    {
                        unset($category->parentId);
                        $insertId = $categoryModel->save();
                        if(!$insertId)
                        {
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $category->resetData();
                        $category->path = $insertId;
                        $category->categoryId = $insertId;
                        $result = $categoryModel->save();
                    }
                    else
                    {
                        $insertId = $categoryModel->save();
                        if(!$insertId)
                        {
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $category->categoryId = $insertId;
                        $parentPath = $categoryModel->load($category->parentId);
                        $category->path = $parentPath->path."/". $insertId;
                        $result = $category->save();
                    }
                    if(!$result)
                    {
                        throw new Exception("Sysetm is unable to save your data", 1);   
                    }
                }
                $this->redirect($this->getView()->getUrl('grid','category',[],true));
            }
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }
}
