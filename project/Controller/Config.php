<?php Ccc::loadClass('Controller_Admin_Action');  ?>
<?php
class Controller_Config extends Controller_Admin_Action
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
		$this->setTitle('Config_Grid');
		$content = $this->getLayout()->getContent();
		$configGrid = Ccc::getBlock('Config_Grid');
		$content->addChild($configGrid,'Grid');
		$this->renderLayout();
	}

	public function gridContentAction()
	{
		$this->setTitle('Config_Grid');
		$content = $this->getLayout()->getContent();
		$configGrid = Ccc::getBlock('Config_Grid');
		$content->addChild($configGrid,'Grid');
		$this->renderContent();
	}

	public function addAction()
	{
		$this->setTitle('Config_Add');
		$configModel = Ccc::getModel('Config');
		$content = $this->getLayout()->getContent();
		$configAdd = Ccc::getBlock('Config_Edit');
		Ccc::register('config',$configModel);
		$content->addChild($configAdd,'Add');
		$this->renderContent();
	}

	public function editAction()
	{
		try 
   		{
   			$this->setTitle('Config_Edit');
   			$configModel = Ccc::getModel('Config');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}
			$config = $configModel->load($id);
			if(!$config)
			{
				throw new Exception("System is unable to find record.", 1);
			}
			
			$content = $this->getLayout()->getContent();
			$configEdit = Ccc::getBlock('Config_Edit');
			Ccc::register('config',$config);
			$content->addChild($configEdit,'Edit');
			$this->renderContent();
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
			$configModel = Ccc::getModel('Config');
			$request = $this->getRequest();
			if(!$request->getPost('config'))
			{
				throw new Exception("Invalid Request.", 1);
			}
			$postData = $request->getPost('config');
			if(!$postData)
			{
				throw new Exception("Invalid data posted.", 1);	
			}

			$config = $configModel;
			$config->setData($postData);
			if(!($config->configId))
			{
				$config->createdAt = date('Y-m-d H:m:s');
				unset($config->configId);
			}
			else
			{
				if(!(int)$config->configId)
				{
					throw new Exception("Invalid Request.", 1);
				}
				$config->configId = $postData["configId"];
			}
			$result = $config->save();
			if(!$result)
			{
				throw new Exception("System is unable to Update.", 1);
			}
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
			$configModel = Ccc::getModel('Config');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$configId = $request->getRequest('id');
			if(!$configId)
			{
				throw new Exception("Unable to fetch ID.", 1);
			}
			$result = $configModel->load($configId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delete Record.", 1);
			}
			$this->renderContent();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());				
		}
	}
}

