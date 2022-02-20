<?php Ccc::loadClass('Controller_Core_Action'); 
Ccc::loadClass('Model_Core_Request');
?>
<?php

class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Customer_Add')->toHtml();
	}

	public function editAction()
	{
		$customerModel = Ccc::getModel('Customer');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}
			$customer = $customerModel->fetchRow("SELECT * FROM customer WHERE customerId = {$id}");
			if(!$customer)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			$addressModel = Ccc::getModel('Customer_Address');
			$address = $addressModel->fetchRow("SELECT * FROM address WHERE customerId = {$id}");
			if(!$address)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			Ccc::getBlock('Customer_Edit')->addData('customer',$customer)->addData('address',$address)->toHtml();
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
			
			$result = $customerModel->delete($customerId);
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
			}
			$this->redirect($this->getView()->getUrl('customer','grid',[],true));
			} 
			catch (Exception $e) 
			{
				$this->redirect($this->getView()->getUrl('customer','grid',[],true));
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

		if (array_key_exists('customerId',$postData))
		{
			if(!(int)$postData['customerId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$customerId = $postData["customerId"];
			$postData['updatedAt']  = date('y-m-d h:m:s');
			$update = $customerModel->update($postData,$customerId);

		}
		else
		{
			$postData['createdAt'] = date('y-m-d h:m:s');
			$insert = $customerModel->insert($postData);
			if($insert==null)
			{
				throw new Exception("System is unable to Insert.", 1);
			}
			return $insert;
		}	 
	}

	protected function saveAddress($customer_id)
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

		if (array_key_exists('customerId',$postData))
		{
			if($customerId)
			{
				throw new Exception("Invalid Request.", 1);
			}
			$update = $addressModel->update($postData,$postData['customerId']);
			if(!$update)
			{
				throw new Exception("System is unable to Update.", 1);
			}
		}
		else
		{
			
			$postData['customerId'] = $customerId;

			$insert = $addressModel->insert($postData);
			if(!$insert)
			{
				throw new Exception("System is unable to Insert.", 1);
			}
		}
	}

	public function saveAction()
	{
		try
		{
			$customerId = $this->saveCustomer();
			$request = $this->getRequest();
			if(!$request->getPost('address'))
			{
				$this->redirect($this->getView()->getUrl('customer','grid',[],true));
			}
			$this->saveAddress($customerId);
			$this->redirect($this->getView()->getUrl('customer','grid',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('customer','grid',[],true));
		}
	}
}
?>