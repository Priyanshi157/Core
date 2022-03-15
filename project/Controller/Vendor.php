<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php

class Controller_Vendor extends Controller_Admin_Action
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
		$this->setTitle('Vendor_Grid');
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
		$this->setTitle('Vendor_Add');
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
			$this->setTitle('Vendor_Edit');
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
		return $result;
	}

	protected function saveAddress($vendor)
	{
		$request = $this->getRequest();
		$address = $vendor->getAddress();
		$postData = $request->getPost('address');
		if(!$postData)
		{
			throw new Exception("Invalid Request.", 1);
			
		}

		if(!$address->addressId)
		{
			unset($address->addressId);
		}
		$address->setData($postData);
		$address->vendorId=$vendor->vendorId;
		$save = $address->save();
		if(!$save->addressId)
		{
			$this->getMessage()->addMessage('Address Inserted succesfully.',1);
			throw new Exception("Unable to Save.", 1);	
		}
	}

	public function saveAction()
	{
		try
		{
			$vendorId = $this->saveVendor();
			$request = $this->getRequest();
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
