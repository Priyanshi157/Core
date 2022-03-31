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
	
	public function gridAction()
	{
		$this->setTitle('Page_Grid');
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Page_Grid');
		$content->addChild($pageGrid,'Grid');
		$this->renderLayout();
	}

	public function gridContentAction()
	{
		$this->setTitle('Page_Grid');
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Page_Grid');
		$content->addChild($pageGrid,'Grid');
		$this->renderContent();
	}

	public function addAction()
	{
		$this->setTitle('Page_Add');
		$pageModel = Ccc::getModel('Page');
		$content = $this->getLayout()->getContent();
		$pageAdd = Ccc::getBlock('Page_Edit');
		Ccc::register('page',$pageModel);
		$content->addChild($pageAdd,'Add');
		$this->renderContent();
	}

	public function editAction()
	{
		try 
		{
			$this->setTitle('Page_Edit');
			$pageModel = Ccc::getModel('Page');
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request.", 1);
			}	
			$page = $pageModel;
			$pageData = $page->load($id);
			if(!$pageData)
			{
				throw new Exception("SYstem is unable to fetch record.", 1);
			}
			$content = $this->getLayout()->getContent();
			$pageEdit = Ccc::getBlock('Page_Edit');
			Ccc::register('page',$pageData);
			$content->addChild($pageEdit,'Edit');
			$this->renderContent();
		} 
		catch (Exception $e) 
		{
			throw new Exception("System is unable to find record.", 1);
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
			if(!$page->pageId)
			{
				$page->createdAt = date('Y-m-d H:m:s');
				unset($page->pageId);
			}
			else
			{
				if(!(int)$page->pageId)
				{
					throw new Exception("Invalid Request.", 1);
				}
				$page->updatedAt = date('Y-m-d H:m:s');
			}
			$result = $page->save();
			if(!$result)
			{
				$this->getMessage()->addMessage('System is unable to save data.');
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
			$this->renderContent();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());
		}
	}
}
