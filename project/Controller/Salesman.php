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

	public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock('Salesman_Index');
		$content->addChild($salesmanGrid);
		$this->renderLayout();
	}
	
	public function gridBlockAction()
	{
		$salesmanGrid = Ccc::getBlock('Salesman_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmanGrid,
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
		$salesmanModel = Ccc::getModel("Salesman");
		$salesman = $salesmanModel;

		Ccc::register('salesman',$salesman);
		$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmanEdit,
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
			$salesmanModel = Ccc::getModel('Salesman');
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!$id)
			{
				throw new Exception("Invalid Request.", 1);
			}

			$salesman = $salesmanModel->load($id);
			if(!$salesman)
			{
				throw new Exception("System is unable to find record.", 1);
			}

			Ccc::register('salesman',$salesman);
			$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $salesmanEdit,
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
			$this->getMessage()->addMessage($e->getMessage(),3);
			$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $salesmanEdit,
						],
					[
						'element' => '#adminMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->renderJson($response);
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
			$this->getMessage()->addMessage('Added Successfully.',1);
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),3);
			$this->gridBlockAction();
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
			if($customers)
			{
				foreach($customers as $customer)
				{
					$customerPrices = $customerPriceModel->fetchAll("SELECT `entityId` FROM `customer_price` WHERE `customerId` = {$customer->customerId}");
					foreach ($customerPrices as $customerPrice) 
					{
						$customerPriceModel->load($customerPrice->entityId)->delete();
					}
				}
			}
			
			$salesmanData = $salesman->load($id)->delete();
			if(!$salesmanData)
			{
				throw new Exception("System is unable to find record.", 1);
			}
			$this->getMessage()->addMessage('Deleted Successfully.');
			$this->gridBlockAction();
		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage(),3);
			$this->gridBlockAction();
		}
	}
}
