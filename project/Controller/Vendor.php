<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php

class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Vendor_Grid')->toHtml();
	}

	public function addAction()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$addressModel = Ccc::getModel('Vendor_Address');
		Ccc::getBlock('Vendor_Edit')->setData(['vendor'=>$vendorModel,'address'=>$addressModel])->toHtml();
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
			Ccc::getBlock('Vendor_Edit')->addData('vendor',$vendor)->addData('address',$address)->toHtml();
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
			$insert = $vendor->save();
			if($insert==null)
			{
				throw new Exception("System is unable to Insert.", 1);
			}
			return $insert;
		}
		else
		{
			if(!(int)$postData['vendorId'])
			{
				throw new Exception("Invalid Request.", 1);
			}
			$vendor->vendorId = $postData["vendorId"];
			$vendor->updatedAt = date('y-m-d h:m:s');
			$update = $vendor->save();
			return $vendor->vendorId;
		}	 
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
			unset($address->addressId);
			$insert = $address->save();
			if(!$insert)
			{
				throw new Exception("System is unable to Insert.", 1);
			}
		}
		else
		{		
			$update = $address->save();
			if(!$update)
			{
				throw new Exception("System is unable to Update.", 1);
			}
		}
	}

	public function saveAction()
	{
		try
		{
			$vendorId = $this->saveVendor();
			$request = $this->getRequest();
			if(!$request->getPost('address')['postalCode'] )
			{
				$this->redirect($this->getView()->getUrl('grid','vendor',[],true));
			}
			$this->saveAddress($vendorId);
			$this->redirect($this->getView()->getUrl('grid','vendor',[],true));
		} 
		catch (Exception $e) 
		{
			print_r($e->getMessage());
			//$this->redirect($this->getView()->getUrl('grid','vendor',[],true));
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
			$this->redirect($this->getView()->getUrl('grid','vendor',[],true));
		} 
		catch (Exception $e) 
		{
			print_r($e->getMessage());
			//$this->redirect($this->getView()->getUrl('grid','vendor',[],true));
		}
	}
}
?>