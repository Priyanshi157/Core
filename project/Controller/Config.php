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
	
	public function indexAction()
	{
		$this->setTitle('Config');
		$content = $this->getLayout()->getContent();
		$configGrid = Ccc::getBlock('Config_Index');
		$content->addChild($configGrid);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' =>  $configGrid
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->renderJson($response);
	}

	public function addBlockAction()
	{
		$configModel = Ccc::getModel('Config');
		$config = $configModel;
		Ccc::register('config',$config);
		$configEdit = $this->getLayout()->getBlock('Config_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $configEdit
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->renderJson($response);
	}

	public function editBlockAction()
	{
		try 
		{
			$configModel = Ccc::getModel("Config");
			$request = $this->getRequest();
			$configId = $request->getRequest('id');
			if(!(int)$configId)
			{
				$this->getMessage()->addMessage('Your data can not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}

			$config = $configModel->load($configId);
			if(!$config)
			{
				$this->getMessage()->addMessage('Your data can not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}
	
			Ccc::register('config',$config);

			$configEdit = Ccc::getBlock('Config_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $configEdit
					],
					[
						'element' => '#adminMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->renderJson($response);
		}
		catch (Exception $e)
		{
			$this->gridBlockAction();
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
			if(!(int)$config->configId)
			{
				$config->createdAt = date('Y-m-d H:m:s');
				unset($config->configId);
			}
			
			$config->configId = $postData["configId"];
			$result = $config->save();
			if(!$result)
			{
				throw new Exception("System is unable to Update.", 1);
			}
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());
			$this->gridBlockAction();
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
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());				
		}
	}
}

