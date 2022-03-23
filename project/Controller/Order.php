<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Order extends Controller_Admin_Action{

	public function __construct()
	{
		$this->setTitle('Order');
		if(!$this->authentication())
		{
			$this->redirect('login','Admin_login');
		}
	}
	public function gridAction()
	{
		$this->setTitle('Order_Grid');
		$content = $this->getLayout()->getContent();
		$orderGrid = Ccc::getBlock('Order_Grid');
		$content->addChild($orderGrid,'Grid');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$message = Ccc::getBlock('Core_Layout_Message');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu')->addChild($message,'message');
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$orderModel = Ccc::getModel("Order");
			$request = $this->getRequest();
			$orderId = $request->getRequest('id');
			if(!$orderId)
			{
				$this->getMessage()->addMessage('System is unable to fetch data.',3);
				throw new Exception('Invalid Request', 1);
			}

			if(!(int)$orderId)
			{
				$this->getMessage()->addMessage('SYstem is unable to fetch data.',3);
				throw new Exception('Invalid Request', 1);
			}

			$order = $orderModel->load($orderId);
			if(!$order)
			{
				$this->getMessage()->addMessage('System is unable to fetch data.',3);
				throw new Exception('Invalid Request', 1);
			}
			
			$content = $this->getLayout()->getContent();
			$orderEdit = Ccc::getBlock('Order_Edit')->setData(['order'=>$order]);
			$content->addChild($orderEdit,'Edit');
			$menu = Ccc::getBlock('Core_Layout_Menu');
			$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
			$this->renderLayout();
		}
		catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),3);
			$this->redirect('grid','order');
		}
	}
}

?>