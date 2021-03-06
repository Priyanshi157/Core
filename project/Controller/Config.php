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
			$request=$this->getRequest();
			$configModel= Ccc::getModel('Config');
			if(!$request->isPost())
			{
				throw new Exception("Request Invalid.",1);
			}

			$postData=$request->getPost('config');
			if(!$postData)
			{
				throw new Exception("Invalid data Posted.", 1);
				
			}

			$config=$configModel;
			$config->setData($postData);
			if(!$config->configId)
			{
				unset($config->configId);
				$config->createdAt = date('y-m-d h:m:s');
			}
			else
			{
				if(!(int)$config->configId)
				{
					throw new Exception("Invalid Request.",1);
				}
			}
			$result=$config->save();
			if(!$result)
			{
				$this->getMessage()->addMessage('Unable to save record.',3);
				throw new Exception("Unable to Save Record.", 1);
				
			}	
			$this->getMessage()->addMessage('Data save succesfully',1);
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),3);
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
			$this->getMessage()->addMessage('Data deleted succesfully',1);
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),3);				
			$this->gridBlockAction();
		}
	}
}

