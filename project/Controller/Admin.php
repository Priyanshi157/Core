<?php Ccc::loadClass('Controller_Core_Action');  ?>
<?php Ccc::loadClass('Model_Admin'); ?>
<?php
class Controller_Admin extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Admin_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Admin_Add')->toHtml();
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
			$admin = $adminModel->fetchRow("SELECT * FROM admin WHERE adminId = {$aid}");
			if(!$admin)
			{
				throw new Exception("System is unable to find record.", 1);
			}
			Ccc::getBlock('Admin_Edit')->addData('admin',$admin)->toHtml();
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
		
			if(array_key_exists('adminId', $postData))
			{
				if(!(int)$postData['adminId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				
				$adminId = $postData['adminId'];
				$postData['updatedAt'] = date('Y-m-d H:m:s');
				$update = $adminModel->update($postData,$adminId);
				if(!$update)
				{
					throw new Exception("System is unable to Update.", 1);
				}
			}
			else
			{
				$postData['createdAt'] = date('Y-m-d H:m:s');
				$insert = $adminModel->insert($postData);
			}
			$this->redirect($this->getView()->getUrl('admin','grid',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('admin','grid',[],true));
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

			$result = $adminModel->delete($adminId);
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
				
			}
			$this->redirect($this->getView()->getUrl('admin','grid',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('admin','grid',[],true));
		}
	}
}

?>