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
		$this->getCart()->unsetCart();
		$this->setTitle('Cart_Grid');
		$content = $this->getLayout()->getContent();
		$cartGrid = Ccc::getBlock('Cart_Grid');
		$content->addChild($cartGrid,'Grid');
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle('Cart_Add');
		$cartModel = Ccc::getModel('Cart');
		$content = $this->getLayout()->getContent();
		$cartAdd = Ccc::getBlock('Cart_Edit'); 
		$cartModel = $cartAdd->cart = $cartModel;
		$content->addChild($cartAdd);
		$this->renderLayout();
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$cartModel = Ccc::getModel('Cart');
		if($this->getCart()->getCart())
		{
			$cartId = $this->getCart()->getCart()['cartId'];
			$cart = $cartModel->load($cartId);
		}
		else
		{
			$cartId = null;
		}

		$content = $this->getLayout()->getContent();
		if(!$cartId)
		{
			$customer = $cartModel->getCustomer();
			$item = $cartModel->getItem();
			$billingAddress = $cartModel->getBillingAddress();
			$shipingAddress = $cartModel->getShipingAddress();
			$cart = $cartModel;
		}
		else
		{
			$cart = $cart;
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
			if($this->getCart()->getCart())
			{
				$this->redirect('edit');
			}
			else
			{
				$cartModel = Ccc::getModel('Cart');
				$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId} ");
				if($cart)
				{
					$this->getCart()->addCart($cart->cartId);
					$this->redirect('edit');
				}
				else
				{
					$cartModel->customerId = $customerId;
					$cartModel->status = 1;
					$cart = $cartModel->save();
					if(!$cart)
					{
						$this->getMessage()->addmessage("Cart not added.");
					}
					$this->saveAddressAction($cart);
					$this->getCart()->addCart($cart->cartId);
				}
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
            if(!$customerId)
            {
                throw new Exception("Request Invalid.");
            }
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
            $this->getMessage()->addMessage("Address Saved.");
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid');
        }
    }

	public function saveCartAddressAction()
	{
		try 
		{
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cartId'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
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
			$this->redirect('edit','cart',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit','cart',[],true);
		}
		
	}

	public function savePaymentMethodAction()
	{
		try 
		{
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cartId'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
			$paymentData = $request->getPost('paymentMethod');
			$cart->setData(['paymentMethod' => $paymentData]);
			$cart->save();
			$this->redirect('edit','cart',[],true);	
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit','cart',[],true);	
		}
		
	}

	public function saveShipingMethodAction()
	{
		try 
		{
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cartId'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
			$shipingMethod = $request->getPost('shipingMethod');

			if($shipingMethod == '1')
			{
				$shipingCost = 100;
			}
			elseif($shipingMethod == '2')
			{
				$shipingCost = 70;
			}
			else
			{
				$shipingCost = 50;
			}

			$cart->setData(['shipingMethod' => $shipingMethod, 'shipingCost' => $shipingCost]);
			$cart->save();
			$this->redirect('edit','cart',[],true);	
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit','cart',[],true);	
		}	
	}

	public function addCartItemAction()
	{
		try 
		{
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cartId'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
			$productModel = Ccc::getModel('Product');
			$cartData = $request->getPost('cartItem');
			$item = $cart->getItem();
			$item->cartId = $cart->cartId;
			foreach($cartData as $cartItem)
			{
				if(array_key_exists('productId',$cartItem))
				{
					$product = $productModel->load($cartItem['productId']);
					if($product->quantity > $cartItem['quantity'])
					{
						unset($item->itemId);
                        $item->setData($cartItem);
                        $item->itemTotal = $product->price * $cartItem['quantity'];
                        $item->tax = $product->tax;
                        $item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
                        $item->discount = ($product->discount * $cartItem['quantity']); 
                        $item->save();
                        $taxAmount += ($product->price * $product->tax / 100) * $cartItem['quantity'];
                        $discount +=($product->discount * $cartItem['quantity']);
                        unset($item->itemId);
					}
				}
			}
			$subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
            $cart->subTotal = $subTotal->subTotal;
            $cart->taxAmount += $taxAmount;
            $cart->discount += $discount;
            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("subTotal not updated", 1);
            }

			$this->redirect('edit','cart',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit','cart',[],true);
		}
	}

	public function cartItemUpdateAction()
	{
		try 
		{
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cartId'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
			$productModel = Ccc::getModel('Product');
			$cartData = $request->getPost('cartItem');
			$item = $cart->getItem();
			foreach($cartData as $cartItem)
			{
				$product = $productModel->load($cartItem['productId']);
				if($product->quantity > $cartItem['quantity'])
				{
					$item->setData($cartItem);
                    $item->itemTotal = $product->price * $cartItem['quantity'];
                    $item->discount = $product->discount * $cartItem['quantity'];
                    $item->tax = $product->tax;
                    $item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
                    $taxAmount += ($product->price * $product->tax / 100) * $cartItem['quantity'];
                    $discount += $product->discount * $cartItem['quantity'];
                    $item->save();
				}
			}
			$subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
            $cart->subTotal = $subTotal->subTotal;
            $cart->taxAmount = $taxAmount;
            $cart->discount = $discount;
            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("SubTotal not updated", 1);
            }

			$this->redirect('edit','cart',[],true);
		} 
		catch (Exception $e) 
		{	
			$this->redirect('edit','cart',[],true);
		}
	}

	public function deleteCartItemAction()
	{
		try 
		{
			$request = $this->getRequest();
			$itemId = $request->getRequest('itemId');
			$item = Ccc::getModel('Cart_Item');
			$cart = $item->getCart();
			$cart->subTotal = $cart->subTotal - $item->itemTotal;
			$cart->taxAmount = $cart->taxAmount - $item->taxAmount;
			$cart->discount = $cart->discount - $item->discount;
			$cart->save();
			$result = $item->load($itemId)->delete();
			if(!$result)
			{
				$this->getMessage()->addMessage("Unable to fetchand delete cart items.");
				throw new Exception("Cart item not deleted.", 1);
			}
			$this->getMessage()->addMessage("Cart deleted successfully.");
			$this->redirect('edit',null,['itemId' => null],true);	
		} 
		catch (Exception $e) 
		{
			$this->redirect('edit',null,['itemId' => null],true);		
		}
	}

	public function placeOrderAction()
	{
		try 
		{
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cartId'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
			$productModel = Ccc::getModel('Product');
			$customer = $cart->getCustomer();
			$orderModel = Ccc::getModel('order');			
			$orderModel->customerId = $customer->customerId;
			$orderModel->firstName = $customer->firstName;
			$orderModel->lastName = $customer->lastName;
			$orderModel->email = $customer->email;
			$orderModel->mobile = $customer->mobile;
			$orderModel->shipingId = $cart->shipingMethod;
			$orderModel->shipingCost = $cart->shipingCost;
			$orderModel->paymentId = $cart->paymentMethod;
			$orderModel->grandTotal = $request->getPost('grandTotal');
			$orderModel->taxAmount = $request->getPost('taxAmount');
			$orderModel->discount = $request->getPost('discount');
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
				$itemModel->tax = $product->tax;
				$itemModel->taxAmount = ($product->price * $product->tax / 100) * $item->quantity;
				$itemModel->discount = $item->discount;
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
			$this->getMessage()->addMessage('Order placed successfully.');
			$this->redirect('grid','cart',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','cart',[],true);	
		}
		
	}
}