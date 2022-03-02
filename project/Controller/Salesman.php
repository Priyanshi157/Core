<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock('Salesman_Grid');
		$content->addChild($salesmanGrid,'Grid');
		$this->renderLayout();
	}

	public function addAction()
	{
		$salesmanModel = Ccc::getModel('Salesman');
		$content = $this->getLayout()->getContent();
		$salesmanAdd = Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesmanModel]);
		$content->addChild($salesmanAdd,'Add');
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$salesmanModel = Ccc::getModel('Salesman');
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request.", 1);
			}

			$salesman = $salesmanModel;
			$salesmanData = $salesman->load($id);
			if(!$salesmanData)
			{
				throw new Exception("System is unable to find record.", 1);
			}
			$content = $this->getLayout()->getContent();
			$salesmanEdit = Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesmanData]);
			$content->addChild($salesmanEdit,'Edit');
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
			$salesmanModel = Ccc::getModel('salesman');
			$request = $this->getRequest();
			$postData = $request->getPost('salesman');
			if(!$postData)
			{
				throw new Exception("System is unable to find record.", 1);
			}		

			$salesman = $salesmanModel;
			$salesman->setData($postData);

			if(!$salesman->salesmanId)
			{
				$salesman->createdAt = date('Y-m-d H:m:s');
				unset($salesman->salesmanId);
				$insert = $salesman->save();
				if(!$insert)
				{
					throw new Exception("System is unable to find record.", 1);
				}
			}
			else
			{
				if(!(int)$salesman->salesmanId)
				{
					throw new Exception("Invalid Request.", 1);
				}
				$salesman->updatedAt = date('Y-m-d H:m:s');
				$update = $salesman->save();
				if(!$update)
				{
					throw new Exception("System is unable to fetch record.", 1);
				}
			}
			$this->redirect($this->getView()->getUrl('grid','salesman',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','salesman',[],true));
		}	
	}

	public function deleteAction()
	{
		try 
		{
			$salesmanModel = Ccc::getModel('Salesman');
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request.", 1);
			}

			$salesman = $salesmanModel;
			$salesmanData = $salesman->load($id)->delete();
			if(!$salesmanData)
			{
				throw new Exception("System is unable to find record.", 1);
			}
			$this->redirect($this->getView()->getUrl('grid','salesman',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','salesman',[],true));
		}
	}
}
?>