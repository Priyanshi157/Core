<?php Ccc::loadClass('Controller_Admin_Action') ?>
<?php

class Controller_Customer_Price extends Controller_Admin_Action
{
	public function __construct()
	{
		if(!$this->authentication())
		{
			$this->redirect('login','admin_login');
		}
	}

	public function gridCustomerBlockAction()
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

	public function gridBlockAction()
	{
		$customerPriceGrid = Ccc::getBlock('Customer_Price_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' =>  $customerPriceGrid
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->renderJson($response);
	}

	public function saveAction()
	{
		try 
		{
			$this->setTitle('Customer_Price_Edit');
			$customerPriceModel = Ccc::getModel('Customer_Price');
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			if($request->isPost())
			{
				$customers = $customerPriceModel->fetchAll("SELECT * FROM `customer_price` WHERE `customerId` = '$customerId'");
				if($customers)
				{
					foreach($customers as $customer)
					{
						$customerPriceModel->load($customer->customerId,'customerId')->delete();
					}
				}
				
				$customerData = $request->getPost('product');
				$customerPriceModel->customerId = $customerId;
				foreach($customerData as $customer)
				{
					if($customer['salesmanPrice'] <= $customer['price'])
					{
						$customerPriceModel->price = $customer['price'];
					}
					else
					{
						$customerPriceModel->price = $customer['salesmanPrice'];
					}
					if($customer['price'])
					{
						$customerPriceModel->productId = $customer['productId'];
						$customerPriceModel->save();
						unset($customerPriceModel->entityId);
					}
				}
			}
			$this->gridBlockAction();
		}
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());
			$this->gridBlockAction();
		}
	}
}