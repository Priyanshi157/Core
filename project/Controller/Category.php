<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php 

class Controller_Category extends Controller_Admin_Action
{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock('Category_Grid');
        $content->addChild($categoryGrid,'Grid');
                $menu = Ccc::getBlock('Core_Layout_Menu');
        $message = Ccc::getBlock('Core_Layout_Message');
        $header = $this->getLayout()->getHeader()->addChild($menu,'menu')->addChild($message,'message');
        $this->renderLayout();
	}
	
	public function addAction()
	{
		$categoryModel = Ccc::getModel('Category');
        $content = $this->getLayout()->getContent();
        $categoryAdd = Ccc::getBlock('Category_Edit')->setData(['category'=>$categoryModel]);
        $content->addChild($categoryAdd,'Add');
        $menu = Ccc::getBlock('Core_Layout_Menu');
        $header = $this->getLayout()->getHeader()->addChild($menu,'menu');
        $this->renderLayout();
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
        	$content = $this->getLayout()->getContent();
            $categoryEdit = Ccc::getBlock('Category_Edit')->setData(['category'=>$category]);
            $content->addChild($categoryEdit,'Edit');
            $menu = Ccc::getBlock('Core_Layout_Menu');
            $header = $this->getLayout()->getHeader()->addChild($menu,'menu');
            $this->renderLayout();
		}
		catch (Exception $e) 
		{
			throw new Exception("System is unable to fetch.", 1);	
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
                $categoryData = $categoryModel->setData($postData);
                if(!empty($id))
                {
                    $categoryData->categoryId = $id;
                    $categoryData->updatedAt = date('y-m-d h:m:s');
                    if(!$postData['parentId'])
                    {
                        $categoryData->parentId = NULL;
                    }
                    $result = $categoryModel->save();
                    if(!$result)
                    {
                        $this->getMessage()->addMessage('unable to update.',1);
                        throw new Exception("System is unable to save your data", 1);   
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
                    $this->getMessage()->addMessage('Data Updated Successfully.',1);
                }
                else
                {
                    $categoryData->createdAt = date('y-m-d h:m:s');
                    if(!$categoryData->parentId)
                    {
                        unset($categoryData->parentId);
                        $insert = $categoryModel->save();
                        $categoryId = $insert->categoryId;
                        if(!$insert->categoryId)
                        {
                            $this->getMessage()->addMessage('System is unable to Insert Data.',3);
                            throw new Exception("System is unable to insert your data");
                        }
                        $categoryData->resetData();
                        $categoryData->path = $categoryId;
                        $categoryData->categoryId = $categoryId;
                        $result = $categoryModel->save();
                        $this->getMessage()->addMessage('Data inserted successfully',1);
                    }
                    else
                    {
                        $insert = $categoryModel->save();
                        if(!$insert->categoryId)
                        {
                            throw new Exception("System is unable to insert your data", 1);
                        }
                        $categoryData->categoryId = $insert->categoryId;
                        $parentPath = $categoryModel->load($categoryData->parentId);
                        $categoryData->path = $parentPath->path."/". $insert->categoryId;
                        $result = $categoryData->save();
                    }
                    if(!$result)
                    {
                        $this->getMessage()->addMessage('Unable to insert data.',3);
                        throw new Exception("Sysetm is unable to save your data", 1);   
                    }
                }
                $this->getMessage()->addMessage('Data inserted successfully',1);
                $this->redirect('grid','category',[],true);
            }
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
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
            $this->getMessage()->addMessage('Deleted Successfully.');
            $this->redirect('grid','category',[],true);
        } 
        catch (Exception $e) 
        {
            $this->redirect('grid','category',[],true);
        }
    }
}
