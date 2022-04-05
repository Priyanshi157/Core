<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php 
class Controller_Page extends Controller_Admin_Action
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
		$this->setTitle('Page');
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Page_Index');
		$content->addChild($pageGrid);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		$pageGrid = Ccc::getBlock('Page_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' =>  $pageGrid
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
		$pageModel = Ccc::getModel('Page');
		$page = $pageModel;
		Ccc::register('page',$page);
		$pageEdit = $this->getLayout()->getBlock('Page_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $pageEdit
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
			$pageModel = Ccc::getModel("Page");
			$request = $this->getRequest();
			$pageId = $request->getRequest('id');
			if(!(int)$pageId)
			{
				$this->getMessage()->addMessage('Your data can not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}

			$page = $pageModel->load($pageId);
			if(!$page)
			{
				$this->getMessage()->addMessage('Your data can not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}
	
			Ccc::register('page',$page);
			$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $pageEdit
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
			$pageModel = Ccc::getModel('Page');
			$request = $this->getRequest();
			$postData = $request->getPost('page');
			if(!$postData)
			{
				throw new Exception("Invalid Request.", 1);
			}

			$page = $pageModel;
			$page->setData($postData);
			if(!(int)$page->pageId)
			{
				$page->createdAt = date('Y-m-d H:m:s');
				unset($page->pageId);
			}
			else
			{
				$page->updatedAt = date('Y-m-d H:m:s');
			}

			$result = $page->save();
			if(!$result)
			{
				$this->getMessage()->addMessage('System is unable to save data.');
			}
			$this->getMessage()->addMessage('Data saved successfully.');
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
			$pageModel = Ccc::getModel('Page');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request.", 1);
			}	
			$page = $pageModel;
			$result = $page->load($id)->delete();
			if(!$result)
			{
				throw new Exception("System is unable to fetch record.", 1);
			}
			$this->getMessage()->addMessage('Data deleted successfully.',3);
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());
			$this->gridBlockAction();
		}
	}
}
