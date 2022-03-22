<?php Ccc::loadClass('Controller_Admin_Action');  ?>
<?php
class Controller_Cart extends Controller_Admin_Action
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
		$this->setTitle('Cart_Grid');
		$content = $this->getLayout()->getContent();
		$cartGrid = Ccc::getBlock('Cart_Grid');
		$content->addChild($cartGrid,'Grid');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$message = Ccc::getBlock('Core_Layout_Message');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu')->addChild($message,'message');
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle('Cart_Add');
		$cartModel = Ccc::getModel('Cart');
		$content = $this->getLayout()->getContent();
		$cartAdd = Ccc::getBlock('Cart_Edit'); //->setData(['cart'=>$cartModel]);
		$cartModel = $cartAdd->cart = $cartModel;
		$content->addChild($cartAdd);
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
		$this->renderLayout();
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$customerId = $request->getRequest('id');
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$message = Ccc::getBlock('Core_Layout_Message');
		$header->addChild($menu,'menu')->addChild($message,'message');

		$cartModel = Ccc::getModel('Cart');
		$content = $this->getLayout()->getContent();
		if(!$customerId)
		{
			$customer = $cartModel->getCustomer();
			$item = $cartModel->getItem();
			$billingAddress = $cartModel->getBillingAddress();
			$shipingAddress = $cartModel->getShipingAddress();
			$cart = $cartModel;
		}
		else
		{
			$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId}");
			$customer = $cart->getCustomer(true);
			$item = $cart->getItem(true);
			$billingAddress = $cart->getBillingAddress(true);
			$shipingAddress = $cart->getShipingAddress(true);
		}

		$cartModel->customer = $customer;
		$cartModel->item = $item;
		$cartModel->billingAddress = $billingAddress;
		$cartModel->shipingAddress = $shipingAddress;
		$cartModel->cart = $cart;
		$cartEdit = Ccc::getBlock('Cart_Edit');
		$cartEdit->cart = $cartModel;
		$content->addChild($cartEdit);
		$this->renderLayout();
	}

	public function addCartAction()
	{
		try 
		{
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId} ");
			if($cart)
			{
				$this->redirect('edit');
			}
			else
			{
				$cartModel->customerId = $customerId;
				$cart = $cartModel->save();
				if(!$cart)
				{
					$this->getMessage()->addmessage("Cart not added.");
				}
				$this->saveAddressAction($cart);
			}
			$this->redirect('edit');	
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit');	
		}
	}

	public function saveAddressAction($cart)
	{
		try 
		{
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			$customer = $cart->getCustomer();
			$customerBillingAddress = $customer->getBillingAddress();
			$customerShipingAddress = $customer->getShipingAddress();
			if($customerBillingAddress)
			{
				$billingAddress = $cart->getBillingAddress();
				$billingAddress->cartId = $cart->cartId;
				$billingAddress->firstName = $customer->firstName;
				$billingAddress->lastName = $customer->lastName;
				$billingAddress->setData($customerBillingAddress->getData());
				unset($billingAddress->addressId);
				unset($billingAddress->customerId);
				$billingAddress->save();
			}

			if($customerShipingAddress)
			{
				$shipingAddress = $cart->getShipingAddress();
				$shipingAddress->cartId = $cart->cartId;
				$shipingAddress->firstName = $customer->firstName;
				$shipingAddress->lastName = $customer->lastName;
				$shipingAddress->setData($customerShipingAddress->getData());
				unset($shipingAddress->addressId);
				unset($shipingAddress->customerId);
				$shipingAddress->save();
			}		
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
		}
	}

	public function saveCartAddressAction()
	{
		try 
		{
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId}");
			$billingData = $request->getPost('billingAddress');
			$shipingData = $request->getPost('shipingAddress');
			$billingAddress = $cart->getBillingAddress();
			$shipingAddress = $cart->getShipingAddress();
			$billingAddress->setData($billingData);
			$shipingAddress->setData($shipingData);
			$billingAddress->save();
			$shipingAddress->save();

			if($request->getPost('saveInBillingBook'))
			{
				$customer = $cart->getCustomer();
				$customerBillingAddress = $customer->getBillingAddress();
				$customerBillingAddress->setData($billingData);
				unset($customerBillingAddress->firstName);
				unset($customerBillingAddress->lastName);
				$customerBillingAddress->save();
			}

			if($request->getPost('saveInShipingBook'))
			{
				$customer = $cart->getCustomer();
				$customerShipingAddress = $customer->getShipingAddress();
				$customerShipingAddress->setData($shipingData);
				unset($customerShipingAddress->firstName);
				unset($customerShipingAddress->lastName);
				$customerShipingAddress->save();
			}
			$this->redirect('edit');
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit');	
		}
		
	}

	public function savePaymentMethodAction()
	{
		try 
		{
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId}");
			$paymentData = $request->getPost('paymentMethod');
			$cart->setData(['paymentMethod' => $paymentData]);
			$cart->save();
			$this->redirect('edit');	
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit');	
		}
		
	}

	public function saveShipingMethodAction()
	{
		try 
		{
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId}");
			$shipingCost = $request->getPost('shipingMethod');
			if($shipingCost == 100)
			{
				$shipingMethod = '1';
			}
			elseif($shipingCost == 70)
			{
				$shipingMethod = '2';
			}
			else
			{
				$shipingMethod = '3';
			}

			$cart->setData(['shipingMethod' => $shipingMethod, 'shipingCost' => $shipingCost]);
			$cart->save();
			$this->redirect('edit');	
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit');	
		}
		
	}

	public function addCartItemAction()
	{
		try 
		{
			$request = $this->getRequest();
			$productModel = Ccc::getModel('Product');
			$customerId = $request->getRequest('id');
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId}");
			$cartData = $request->getPost('cartItem');
			$item = $cart->getItem();
			$item->cartId = $cart->cartId;
			foreach($cartData as $cartItem)
			{
				if(array_key_exists('productId',$cartItem)){
					$product = $productModel->load($cartItem['productId']);
					if($product->quantity > $cartItem['quantity'])
					{
						unset($item->itemId);
						$item->setData($cartItem);
						$item->itemTotal = $product->price * $cartItem['quantity'];
						$item->save();
						unset($item->itemId);
					}
				}
			}
			$this->redirect('edit');
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit');	
		}
		
	}

	public function cartItemUpdateAction()
	{
		try 
		{
			$request = $this->getRequest();
			$productModel = Ccc::getModel('Product');
			$customerId = $request->getRequest('id');
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId}");
			$cartData = $request->getPost('cartItem');
			$item = $cart->getItem();
			foreach($cartData as $cartItem)
			{
				$product = $productModel->load($cartItem['productId']);
				if($product->quantity > $cartItem['quantity'])
				{
					$item->setData($cartItem);
					$item->itemTotal = $product->price * $cartItem['quantity'];
					$item->save();
				}
			}
			$this->redirect('edit');
		} 
		catch (Exception $e) 
		{	
			$this->redirect('edit');
		}
	}

	public function deleteCartItemAction()
	{
		try 
		{
			$request = $this->getRequest();
			$itemId = $request->getRequest('itemId');
			$item = Ccc::getModel('Cart_Item');
			$result = $item->load($itemId)->delete();
			if($result)
			{
				$this->redirect('edit',null,['itemId' => null]);
			}
			$this->redirect('edit',null,['itemId' => null]);	
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit',null,['itemId' => null]);		
		}	
	}

	public function placeOrderAction()
	{
		try 
		{
			$request = $this->getRequest();
			$productModel = Ccc::getModel('Product');
			$customerId = $request->getRequest('id');
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId}");
			$customer = $cart->getCustomer();
			$orderModel = Ccc::getModel('order');
			$orderModel->customerId = $customerId;
			$orderModel->firstName = $customer->firstName;
			$orderModel->lastName = $customer->lastName;
			$orderModel->email = $customer->email;
			$orderModel->mobile = $customer->mobile;
			$orderModel->shipingId = $cart->shipingMethod;
			$orderModel->shipingCost = $cart->shipingCost;
			$orderModel->paymentId = $cart->paymentMethod;
			$orderModel->grandTotal = $request->getPost('grandTotal');
			$order = $orderModel->save();
			$items = $cart->getItems();

			foreach($items as $item)
			{
				$product = $item->getProduct();
				$itemModel = Ccc::getModel('Order_Item');
				$itemModel->orderId = $order->orderId;
				$itemModel->productId = $product->productId;
				$itemModel->name = $product->name;
				$itemModel->sku = $product->sku;
				$itemModel->price = $item->itemTotal;
				$itemModel->quantity = $item->quantity;
				$result = $itemModel->save();
				if($result)
				{
					$item->delete();
				}
			}
			$addressModel = Ccc::getModel('Order_Address');
			$billingData = $cart->getBillingAddress();
			$shipingData = $cart->getShipingAddress();
			$billingAddress = $order->getBillingAddress();
			$shipingAddress = $order->getShipingAddress();
			unset($billingData->cartId);
			unset($billingData->addressId);
			unset($shipingData->cartId);
			unset($shipingData->addressId);
			$billingAddress->setData($billingData->getData());
			$billingAddress->email = $customer->email;
			$billingAddress->mobile = $customer->mobile;
			$billingAddress->orderId = $order->orderId;
			$shipingAddress->setData($shipingData->getData());
			$shipingAddress->email = $customer->email;
			$shipingAddress->mobile = $customer->mobile;
			$shipingAddress->orderId = $order->orderId;
			$billingResult = $billingAddress->save();
			$shipingResult = $shipingAddress->save();

			if($billingResult)
			{
				$billingData->delete();
			}

			if($shipingResult)
			{
				$shipingData->delete();
			}

			if($order)
			{
				$cart->delete();
			}
			
			$this->redirect('grid','cart',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','cart',[],true);	
		}
		
	}
}