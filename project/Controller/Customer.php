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
		$customerModel = Ccc::getModel('Customer');
		$addressModel = Ccc::getModel('Customer_Address');
		$content = $this->getLayout()->getContent();
		$customerAdd = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customerModel,'address'=>$addressModel]);
		$content->addChild($customerAdd,'Add');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
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

			$addressModel = Ccc::getModel('Customer_Address');
			$address = $addressModel->load($id,'customerId');

			if(!$address)
			{
				$address = Ccc::getModel('customer_address');
			}
			
			$content = $this->getLayout()->getContent();
			$customerEdit = Ccc::getBlock('Customer_Edit')->setData(['customer'=>$customer,'address'=>$address]);
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
		return $result->customerId;
	}

	protected function saveAddress($customerId)
	{
		$addressModel = Ccc::getModel('Customer_Address');
		$request = $this->getRequest();
		if(!$request->getPost('address'))
		{
			throw new Exception("Invalid Request", 1);
		}	
		$postData = $request->getPost('address');
		if(!$postData)
		{
			throw new Exception("Invalid data posted.", 1);	
		}

		$address = $addressModel;
		
		if(!array_key_exists('billing',$postData))
		{
			$address->billing = 2;
		}
		else
		{
			$address->billing = $postData['billing'];
		}

		if(!array_key_exists('shiping',$postData))
		{
			$address->shiping = 2;	
		}
		else
		{
			$address->shiping = $postData['shiping'];
		}

		$address->setData($postData);
		if(!($address->addressId))
		{
			$address->customerId = $customerId;
			unset($address->addressId);
		}
		else
		{		
			$address->customerId = $postData['customerId'];
			$address->addressId = $postData['addressId'];
		}
		
		$result = $address->save();
		if(!$result)
		{
			$this->getMessage()->addMessage('System is unable to save data.',3);
		}
		$this->getMessage()->addMessage('Data saved Successfully.',1);
	}

	public function saveAction()
	{
		try
		{
			$customerId = $this->saveCustomer();
			$request = $this->getRequest();
			if(!$request->getPost('address'))
			{
				$this->redirect($this->getView()->getUrl('grid','customer',[],true));
			}
			$this->saveAddress($customerId);
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
				throw new Exception("Unable to Delet Record.", 1);
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
?>