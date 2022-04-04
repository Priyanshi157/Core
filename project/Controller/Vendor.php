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

	public function indexAction()
	{
		$this->setTitle('Vendor');
		$content = $this->getLayout()->getContent();
		$vendorGrid = Ccc::getBlock('Vendor_Index');
		$content->addChild($vendorGrid);
		$this->renderLayout();
	}

	public function gridBlockAction()
	{
		$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' =>  $vendorGrid
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
		$vendorModel = Ccc::getModel("Vendor");
		$vendor = $vendorModel;
		$address = $vendorModel;
		Ccc::register('vendor',$vendor);
		Ccc::register('address',$address);
		$vendorEdit = $this->getLayout()->getBlock('Vendor_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $vendorEdit
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
			$vendorModel = Ccc::getModel("Vendor");
			$addressModel = Ccc::getModel("Vendor_Address");
			$request = $this->getRequest();
			$vendorId = $request->getRequest('id');
			if(!$vendorId)
			{
				$this->getMessage()->addMessage('Your data can not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}

			if(!(int)$vendorId)
			{
				$this->getMessage()->addMessage('Your data can not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}

			$vendor = $vendorModel->load($vendorId);
			$address = $vendor->getAddress();
			if(!$vendor)
			{
				$this->getMessage()->addMessage('Your data con not be fetch',3);
				throw new Exception("Error Processing Request", 1);			
			}
	
			Ccc::register('vendor',$vendor);
			Ccc::register('address',$address);
			$vendorEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $vendorEdit
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
		if(!(int)$vendor->vendorId)
		{
			$vendor->createdAt = date('y-m-d h:m:s');
			unset($vendor->vendorId);
		}
		else
		{
			$vendor->updatedAt = date('y-m-d h:m:s');
		}

		$result = $vendor->save();
		if(!$result)
		{
			$this->getMessage()->getMessage("System is unable to save the data.",3);
		}
		return $result;
	}

	protected function saveAddress($vendor = null)
	{
		if(!$vendor)
		{
			$vendorId = $this->getRequest()->getRequest('id');
			if(!$vendorId)
			{
				$this->getMessage()->addMessage("Vendor not added.");
				throw new Exception("System is unable to save.", 1);
				
			}
			$vendor = Ccc::getModel('vendor')->load($vendorId);
			$vendor->updatedAt = date('y-m-d h:m:s');
			$vendor->save();
		}
		$request = $this->getRequest();
		$postData = $request->getPost('address');
		if(!$postData)
		{
			throw new Exception("Invalid Request.", 1);
			
		}

		$vendor->updatedAt = date('y-m-d h:m:s');
		$address = $vendor->getAddress();
		if(!$address->addressId)
		{
			unset($address->addressId);
		}
		$address->setData($postData);
		$address->vendorId=$vendor->vendorId;
		$result = $address->save();
		if(!$result)
		{
			$this->getMessage()->addMessage('Address Inserted succesfully.',1);
			throw new Exception("Unable to Save.", 1);	
		}
	}

	public function saveAction()
	{
		try
		{
			if($this->getRequest()->getPost('vendor'))
			{
				$vendor=$this->saveVendor();
				if(!$vendor)
				{
					$this->getMessage()->addMessage('Customer Details Not Saved.',3);
					throw new Exception("System is unable to Save.", 1);
				}
				$this->saveAddress($vendor);
			}

			if($this->getRequest()->getPost('address'))
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
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());
			$this->gridBlockAction();
		}
	}
}
