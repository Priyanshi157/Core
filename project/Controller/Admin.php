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
	
	public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Index');
		$content->addChild($adminGrid);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' =>  $adminGrid
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
		$adminModel = Ccc::getModel('Admin');
		$admin = $adminModel;
		Ccc::register('admin',$admin);
		$adminEdit = $this->getLayout()->getBlock('Admin_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $adminEdit
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
			$adminModel = Ccc::getModel("Admin");
			$request = $this->getRequest();
			$adminId = $request->getRequest('id');
			if(!(int)$adminId)
			{
				$this->getMessage()->addMessage('Your data can not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}

			$admin = $adminModel->load($adminId);
			if(!$admin)
			{
				$this->getMessage()->addMessage('Your data con not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}
	
			Ccc::register('admin',$admin);

			$adminEdit = Ccc::getBlock('Admin_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $adminEdit
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
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());
			$this->gridBlockAction();
		}
	}
}

