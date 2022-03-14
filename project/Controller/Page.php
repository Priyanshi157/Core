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
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$message = Ccc::getBlock('Core_Layout_Message');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu')->addChild($message,'message');
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle('Page_Add');
		$pageModel = Ccc::getModel('Page');
		$content = $this->getLayout()->getContent();
		$pageAdd = Ccc::getBlock('Page_Edit')->setData(['page'=>$pageModel]);
		$content->addChild($pageAdd,'Add');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
		$this->renderLayout();
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
			$pageEdit = Ccc::getBlock('Page_Edit')->setData(['page'=>$pageData]);
			$content->addChild($pageEdit,'Edit');
			$menu = Ccc::getBlock('Core_Layout_Menu');
			$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
			$this->renderLayout();

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
			$this->getMessage()->addMessage('Added Successfully.');
			$this->redirect('grid','page');
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','page',[],true);
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
			$this->getMessage()->addMessage('Deleted Successfully.');
			$this->redirect('grid','page',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','page',[],true);
		}
	}
}
