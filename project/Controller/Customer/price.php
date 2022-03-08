<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Customer_Price extends Controller_Core_Action
{

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock('Customer_Price_Grid');
		$content->addChild($salesmanGrid,'Grid');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$message = Ccc::getBlock('Core_Layout_Message');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu')->addChild($message,'message');
		$this->renderLayout();
	}

	public function saveAction()
	{
		try 
		{
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
					$minimunPrize = (float)$customer['price'] - (float)$customer['price']*(float)$customer['discount']/100;
					if($minimunPrize >= (float)$customer['msp'])
					{
						$customerPriceModel->discount = $customer['discount'];
					}
					else
					{
						$customerPriceModel->discount = 100 - (float)$customer['msp']*100/(float)$customer['price'];
					}
					$customerPriceModel->productId = $customer['productId'];
					$customerPriceModel->save();
				}
			}
			$this->getMessage()->addMessage('Discount set successfully');
			$this->redirect($this->getView()->getUrl('grid','customer_price',[],false));
		}
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','customer_price',[],false));
		}
	}
}

?>