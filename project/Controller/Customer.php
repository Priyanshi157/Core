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

	public function indexAction()
	{
		$this->setTitle('Customer');
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Customer_Index');
		$content->addChild($adminGrid);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		$customerGrid = Ccc::getBlock('Customer_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' =>  $customerGrid
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
		$customerModel = Ccc::getModel("Customer");
		$customer = $customerModel;
		$address = $customerModel;
		Ccc::register('customer',$customer);
		Ccc::register('billingAddress',$address);
		Ccc::register('shipingAddress',$address);
		$customerEdit = $this->getLayout()->getBlock('Customer_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $customerEdit
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
			$customerModel = Ccc::getModel("Customer");
			$addressModel = Ccc::getModel("Customer_Address");
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			if(!$customerId)
			{
				$this->getMessage()->addMessage('Your data can not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}

			if(!(int)$customerId)
			{
				$this->getMessage()->addMessage('Your data can not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}

			$customer = $customerModel->load($customerId);
			$billingAddress = $customer->getBillingAddress();
			$shipingAddress = $customer->getShipingAddress();
			if(!$customer)
			{
				$this->getMessage()->addMessage('Your data con not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}
	
			Ccc::register('customer',$customer);
			Ccc::register('billingAddress',$billingAddress);
			Ccc::register('shipingAddress',$shipingAddress);
			$customerEdit = Ccc::getBlock('Customer_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $customerEdit
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
		if(!(int)$customer->customerId)
		{
			$customer->createdAt = date('y-m-d h:m:s');
			unset($customer->customerId);
		}
		else
		{
			$customer->updatedAt = date('y-m-d h:m:s');
		}

		$result = $customer->save();
		if($result==null)
		{
			$this->getMessage()->addMessage('System is unable to save data.',3);
		}
		return $result;
	}

	protected function saveAddress($customer = null)
	{
		if(!$customer)
		{
			$customerId = $this->getRequest()->getRequest('id');
			if(!$customerId)
			{
				$this->getMessage()->addMessage("Customer not added.");
				throw new Exception("System is unable to save.", 1);
				
			}
			$customer = Ccc::getModel('customer')->load($customerId);
			$customer->updatedAt = date('y-m-d h:m:s');
			$customer->save();
		}
		
		$request = $this->getRequest();	
		$postBilling = $request->getPost('billingAddress');
		$postShiping = $request->getPost('shipingAddress');
		$customer->updatedAt = date('y-m-d h:m:s');
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

		if($postBilling)
		{
			$billing->setData($postBilling);
		}
		else
		{	
			$billing->billing = 1;
			$billing->shiping = 2;
		}
		$billing->customerId = $customer->customerId;
		if($postShiping)
		{
			$shiping->setData($postShiping);
		}
		else
		{
			$shiping->shiping = 1;
			$shiping->billing = 2;
		}	
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
			if($this->getRequest()->getPost('customer'))
			{
				$customer=$this->saveCustomer();
				if(!$customer)
				{
					$this->getMessage()->addMessage('Customer Details Not Saved.',3);
					throw new Exception("System is unable to Save.", 1);
				}
				$this->saveAddress($customer);
			}

			if($this->getRequest()->getPost('billingAddress') || $this->getRequest()->getPost('shipingAddress'))
			{
				$this->saveAddress();
			}
			$this->getMessage()->addMessage("Data saved successfully",1);
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
			$customerModel = Ccc::getModel('Customer');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$customerId = $request->getRequest('id');
			if(!$customerId)
			{
				throw new Exception("Unable to fetch Id.", 1);
			}
			
			$result = $customerModel->load($customerId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delete Record.");
			}
			$this->getMessage()->addMessage("Data Deleted successfully",1);
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());
			$this->gridBlockAction();
		}
	}
}
