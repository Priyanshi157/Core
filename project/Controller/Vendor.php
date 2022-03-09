<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php

class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$vendorGrid = Ccc::getBlock('Vendor_Grid');
		$content->addChild($vendorGrid,'Grid');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$message = Ccc::getBlock('Core_Layout_Message');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu')->addChild($message,'message');
		$this->renderLayout();
	}

	public function addAction()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$addressModel = Ccc::getModel('Vendor_Address');
		$content = $this->getLayout()->getContent();
		$vendorAdd = Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendorModel,'address'=>$addressModel]);
		$content->addChild($vendorAdd,'Add');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$vendorModel = Ccc::getModel('Vendor');
			$request = $this->getRequest();
			$id = (int)$request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request", 1);
			}

			$vendor = $vendorModel->load($id);

			if(!$vendor)
			{
				throw new Exception("System is unable to find record.", 1);	
			}

			$addressModel = Ccc::getModel('Vendor_Address');
			$address = $addressModel->load($id,'vendorId');

			if(!$address)
			{
				$address = Ccc::getModel('Vendor_Address');
			}
			$content = $this->getLayout()->getContent();
			$vendorEdit = Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendor,'address'=>$address]);
			$content->addChild($vendorEdit,'Edit');
			$menu = Ccc::getBlock('Core_Layout_Menu');
			$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			throw new Exception("System is unable to find record.", 1);	
		}
	}

	protected function saveVendor()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$request = $this->getRequest();
		if(!$request->getPost('vendor'))
		{
			throw new Exception("Invalid Request", 1);
		}	
		$postData = $request->getPost('vendor');
		if(!$postData)
		{
			throw new Exception("Invalid data posted.", 1);	
		}

		$vendor = $vendorModel;
		$vendor->setData($postData);
		if(!($vendor->vendorId))
		{
			$vendor->createdAt = date('y-m-d h:m:s');
			unset($vendor->vendorId);
		}
		else
		{
			if(!(int)$postData['vendorId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$vendor->vendorId = $postData["vendorId"];
			$vendor->updatedAt = date('y-m-d h:m:s');
		}	 
		$result = $vendor->save();
		if(!$result)
		{
			$this->getMessage()->getMessage("System is unable to save the data.",3);
		}
		return $result->vendorId;
	}

	protected function saveAddress($vendorId)
	{
		$addressModel = Ccc::getModel('Vendor_Address');
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
		$address->setData($postData);
		$address->vendorId = $vendorId;
		if(!($address->addressId))
		{
			$address->vendorId = $vendorId;
			unset($address->addressId);
		}
		else
		{		
			$address->vendorId = $postData['vendorId'];
			$address->addressId = $postData['addressId'];
		}
		$result = $address->save();
		if(!$result)
		{
			$this->getMessage()->addMessage('Systme is unable to save data.');
		}
		$this->getMessage()->addMessage('Data saved successfully.');
	}

	public function saveAction()
	{
		try
		{
			$vendorId = $this->saveVendor();
			$request = $this->getRequest();
			if(!$request->getPost('address')['postalCode'] )
			{
				$this->redirect('grid','vendor',[],true);
			}
			$this->saveAddress($vendorId);
			$this->redirect('grid','vendor',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','vendor',[],true);
		}
	}

	public function deleteAction()
	{
		try 
		{
			$vendorModel = Ccc::getModel('Vendor');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$vendorId = $request->getRequest('id');
			if(!$vendorId)
			{
				throw new Exception("Unable to fetch ID.", 1);
			}
			
			$result = $vendorModel->load($vendorId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
			}
			$this->getMessage()->addMessage('Deleted Successfully.');
			$this->redirect('grid','vendor',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','vendor',[],true);
		}
	}
}
?>