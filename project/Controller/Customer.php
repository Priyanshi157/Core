<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php

class Controller_Customer extends Controller_Admin_Action
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
		$this->setTitle('Customer_Grid');
		$content = $this->getLayout()->getContent();
		$customerGrid = Ccc::getBlock('Customer_Grid');
		$content->addChild($customerGrid,'Grid');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$message = Ccc::getBlock('Core_Layout_Message');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu')->addChild($message,'message');
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle('Customer_Add');
		$customerModel = Ccc::getModel('Customer');
		$billingAddress = $customerModel->getBillingAddress();
		$shipingAddress = $customerModel->getShipingAddress();
		$content = $this->getLayout()->getContent();
		$customerAdd = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customerModel,'billingAddress'=>$billingAddress , 'shipingAddress'=>$shipingAddress]);
		$content->addChild($customerAdd,'Add');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$this->setTitle('Customer_Edit');
			$customerModel = Ccc::getModel('Customer');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}

			$customer = $customerModel->load($id);
			if(!$customer)
			{
				throw new Exception("System is unable to find record.", 1);	
			}
			$content = $this->getLayout()->getContent();
			$customerEdit = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customer]);
			$content->addChild($customerEdit,'Edit');
			$menu = Ccc::getBlock('Core_Layout_Menu');
			$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			throw new Exception("System is unable to find record.", 1);	
		}
	}

	protected function saveCustomer()
	{
		$customerModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		if(!$request->getPost('customer'))
		{
			throw new Exception("Invalid Request", 1);
		}	

		$postData = $request->getPost('customer');
		if(!$postData)
		{
			throw new Exception("Invalid data posted.", 1);	
		}

		$customer = $customerModel;
		$customer->setData($postData);
		if(!($customer->customerId))
		{
			$customer->createdAt = date('y-m-d h:m:s');
			unset($customer->customerId);
		}
		else
		{
			if(!(int)$postData['customerId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$customer->customerId = $postData["customerId"];
			$customer->updatedAt = date('y-m-d h:m:s');
			$update = $customer->save();
		}	 
		$result = $customer->save();
		if($result==null)
		{
			$this->getMessage()->addMessage('System is unable to save data.',3);
		}
		return $result;
	}

	protected function saveAddress($customer)
	{
		$request = $this->getRequest();	
		$postBilling = $request->getPost('billingAddress');
		$postShiping = $request->getPost('shipingAddress');
		$billing = $customer->getBillingAddress();
		$shiping = $customer->getShipingAddress();
		if(!$billing->addressId)
		{
			unset($billing->addressId);
		}
		
		if(!$shiping->addressId)
		{
			unset($shiping->addressId);
		}

		$billing->setData($postBilling);
		$billing->customerId = $customer->customerId;
		$shiping->setData($postShiping);	
		$shiping->customerId = $customer->customerId;
		$result = $billing->save();
		if(!$result)
		{
			$this->getMessage()->addMessage('Customer Details Not Saved.',3);
			throw new Exception("System is unable to Save.", 1);
		}
		$result = $shiping->save();
		if(!$result)
		{
			$this->getMessage()->addMessage('Customer Details Not Saved.',3);
			throw new Exception("System is unable to Save.", 1);
		}
	}

	public function saveAction()
	{
		try
		{
			$customer = $this->saveCustomer();
			$this->saveAddress($customer);
			$this->redirect('grid','customer',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','customer',[],true);
		}
	}

	public function deleteAction()
	{
		try 
		{
			$customerModel = Ccc::getModel('Customer');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$customerId = $request->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Unable to fetch ID.", 1);
			}
			
			$result = $customerModel->load($customerId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delete Record.", 1);
			}
			$this->getMessage()->addMessage('Deleted Successfully.');
			$this->redirect('grid','customer',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','customer',[],true);
		}
	}
}
