<?php Ccc::loadClass('Controller_Admin_Action');  ?>
<?php
class Controller_Admin extends Controller_Admin_Action
{
	public function __construct()
	{
		if(!$this->authentication())
		{
			$this->redirect('login','admin_login');
		}
	}
	
	public function gridAction()
	{
		$this->setTitle('Admin_Grid');
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adminGrid,'Grid');
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle('Admin_Add');
		$adminModel = Ccc::getModel('Admin');
		$content = $this->getLayout()->getContent();
		$adminAdd = Ccc::getBlock('Admin_Edit'); 
		Ccc::register('admin',$adminModel);
		$content->addChild($adminAdd,'Add');
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
   		{
   			$this->setTitle('Admin_Edit');
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
			$adminEdit = Ccc::getBlock('Admin_Edit');
			Ccc::register('admin',$admin);
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
				$admin->password = md5($postData['password']);
				$admin->createdAt = date('Y-m-d H:m:s');
				unset($admin->adminId);
			}
			else
			{
				if(!(int)$admin->adminId)
				{
					throw new Exception("Invalid Request.", 1);
				}
				unset($admin->password);
				$admin->adminId = $postData["adminId"];
				$admin->updatedAt = date('Y-m-d H:m:s');
				$this->getMessage()->addMessage('Updated Successfully.');
			}
			$result = $admin->save();
			if(!$result)
			{
				$this->getMessage()->addMessage('Unable to save.',3);
			}
			
			$this->getMessage()->addMessage('Data saved Successfully.');
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());
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
			$this->getMessage()->addMessage('Deleted Successfully.');
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());
		}
	}
}

