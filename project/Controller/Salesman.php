<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php 
class Controller_Salesman extends Controller_Admin_Action
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
		$this->setTitle('Salesman_Grid');
		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock('Salesman_Grid');
		$content->addChild($salesmanGrid,'Grid');
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle('Salesman_Add');
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
			$this->setTitle('Salesman_Edit');
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
			$salesman = Ccc::getModel('salesman');
			$request = $this->getRequest();
			$postData = $request->getPost('salesman');
			if(!$postData)
			{
				$this->getMessage()->addMessage("Not able to find data.");
				throw new Exception("System is unable to find record.", 1);
			}		

			$salesman->setData($postData);
			if(!$salesman->salesmanId)
			{
				$salesman->createdAt = date('Y-m-d H:m:s');
				unset($salesman->salesmanId);
			}
			else
			{
				if(!(int)$salesman->salesmanId)
				{
					throw new Exception("Invalid Request.", 1);
				}
				$salesman->updatedAt = date('Y-m-d H:m:s');
			}
			$result = $salesman->save();
			if(!$result)
			{
				$this->getMessage()->addMessage("Unable to save data.");
			}
			$this->getMessage()->addMessage('Added Successfully.');
			$this->redirect('grid','salesman',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','salesman',[],true);
		}	
	}

	public function deleteAction()
	{
		try 
		{
			$salesmanModel = Ccc::getModel('Salesman');
			$customerPriceModel = Ccc::getModel('Customer_Price');
			$customerModel = Ccc::getModel('Customer');
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request.", 1);
			}

			$salesman = $salesmanModel;
			$customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `salesmanId` = {$id}");
			foreach($customers as $customer)
			{
				$customerPrices = $customerPriceModel->fetchAll("SELECT `entityId` FROM `customer_price` WHERE `customerId` = {$customer->customerId}");
				foreach ($customerPrices as $customerPrice) 
				{
					$customerPriceModel->load($customerPrice->entityId)->delete();
				}
			}
			$salesmanData = $salesman->load($id)->delete();
			if(!$salesmanData)
			{
				throw new Exception("System is unable to find record.", 1);
			}
			$this->getMessage()->addMessage('Deleted Successfully.');
			$this->redirect('grid','salesman',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','salesman',[],true);
		}
	}
}
