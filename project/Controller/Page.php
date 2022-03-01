<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Page extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Page_Grid')->toHtml();
	}

	public function addAction()
	{
		$pageModel = Ccc::getModel('Page');
		Ccc::getBlock('Page_Edit')->setData(['page'=>$pageModel])->toHtml();
	}

	public function editAction()
	{
		try 
		{
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
			Ccc::getBlock('Page_Edit')->setData(['page'=>$pageData])->toHtml();
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
				$insert = $page->save();
				if(!$insert)
				{
					throw new Exception("System is unable to insert.", 1);
				}
			}
			else
			{
				if(!(int)$page->pageId)
				{
					throw new Exception("Invalid Request.", 1);
				}
				$page->updatedAt = date('Y-m-d H:m:s');
				$update = $page->save();
				if(!$update)
				{
					throw new Exception("System is unable to fetch the record.", 1);
				}
			}
			$this->redirect($this->getView()->getUrl('grid','page',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','page',[],true));
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
			$this->redirect($this->getView()->getUrl('grid','page',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','page',[],true));
		}
	}
}
?>