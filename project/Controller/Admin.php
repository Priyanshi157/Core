<?php Ccc::loadClass('Controller_Core_Action');  ?>
<?php
class Controller_Admin extends Controller_Core_Action
{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adminGrid,'Grid');
		$this->renderLayout();
	}

	public function addAction()
	{
		$adminModel = Ccc::getModel('Admin');
		$content = $this->getLayout()->getContent();
		$adminAdd = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$adminModel]);
		$content->addChild($adminAdd,'Add');
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
   		{
   			$adminModel = Ccc::getModel('Admin');
			$request = $this->getRequest();
			$aid = (int)$request->getRequest('id');
			if(!$aid)
			{
				throw new Exception("Invalid Request", 1);
			}
			$admin = $adminModel->load($aid);
			if(!$admin)
			{
				throw new Exception("System is unable to find record.", 1);
			}
			
			$content = $this->getLayout()->getContent();
			$adminEdit = Ccc::getBlock('Admin_Edit')->setData(['admin'=>$admin]);
			$content->addChild($adminEdit,'Edit');
			$this->renderLayout();
   		}	 
   		catch (Exception $e) 
   		{
   			throw new Exception("Invalid Request.", 1);
   		}
	}

	public function saveAction()
	{
		try 
		{
			$adminModel = Ccc::getModel('Admin');
			$request = $this->getRequest();
			if(!$request->getPost('admin'))
			{
				throw new Exception("Invalid Request.", 1);
			}
			$postData = $request->getPost('admin');
			if(!$postData)
			{
				throw new Exception("Invalid data posted.", 1);	
			}

			$admin = $adminModel;
			$admin->setData($postData);
			if(!($admin->adminId))
			{
				$admin->createdAt = date('Y-m-d H:m:s');
				unset($admin->adminId);
				$admin->save();
			}
			else
			{
				if(!(int)$admin->adminId)
				{
					throw new Exception("Invalid Request.", 1);
				}
				
				$admin->updatedAt = date('Y-m-d H:m:s');
				$update = $admin->save();
				if(!$update)
				{
					throw new Exception("System is unable to Update.", 1);
				}
			}
			$this->redirect($this->getView()->getUrl('grid','admin',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','admin',[],true));
		}
	}

	public function deleteAction()
	{
		try 
		{
			$adminModel = Ccc::getModel('Admin');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$adminId = $request->getRequest('id');
			if(!$adminId)
			{
				throw new Exception("Unable to fetch ID.", 1);
			}
			$result = $adminModel->load($adminId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
				
			}
			$this->redirect($this->getView()->getUrl('grid','admin',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','admin',[],true));
		}
	}
}

?>