<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_cart extends Controller_Admin_Action{

    public function __construct()
    {
        $this->setTitle('cart');
        if(!$this->authentication())
        {
            $this->redirect('login','admin_login');
        }
    }

    public function indexAction()
    {
        $content = $this->getLayout()->getContent();
        $cartIndex = Ccc::getBlock('Cart_Index');
        $content->addChild($cartIndex);
        $this->renderLayout();
    }

    public function indexBlockAction()
    {
        $cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
        $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
        $cartEditPaymentShiping = Ccc::getBlock('Cart_Edit_PaymentShiping')->toHtml();
        $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#cartAddress',
                    'content' => $cartEditAddress,
                ],
                [
                    'element' => '#paymentShiping',
                    'content' => $cartEditPaymentShiping,
                ],
                [
                    'element' => '#cartProduct',
                    'content' => $cartEditItem,
                ],
                [
                    'element' => '#cartSubTotal',
                    'content' => $cartEditSubTotal,
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
        $this->getCart()->unsetCart();
        $cartGrid = Ccc::getBlock('Cart_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $cartGrid,
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
        $cartEdit = Ccc::getBlock('Cart_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $cartEdit,
                    ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function addCartAction()
    {
        try 
        {
            $request = $this->getRequest();
            $customerId = $request->getRequest('id');
            if($this->getCart()->getCart())
            {
                $this->editBlockAction();   
                exit;
            }
            else
            {
                $cartModel = Ccc::getModel('Cart');
                $cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId}");
                if($cart)
                {
                    $this->getCart()->addCart($cart->cartId);
                    $this->editBlockAction();   
                    exit;
                }
                else
                {
                    $cartModel->customerId = $customerId;
                    $cartModel->status = 1;
                    $cart = $cartModel->save();
                    if(!$cart)
                    {
                        $this->getMessage()->addMessage('Cart can not created');
                    }
                    $this->saveAddressAction($cart);
                    $this->getCart()->addCart($cart->cartId);
                }
                $this->editBlockAction();   
            }
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);    
            $this->editBlockAction();   
        }    
    }

    public function saveAddressAction($cart)
    {
        try 
        {
            $request = $this->getRequest();
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
                if(!$billingAddress)
                {
                    throw new Exception("Billing address not saved.", 1);
                }
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
                if(!$shipingAddress)
                {
                    throw new Exception("Shiping address not saved.", 1);
                }
                return $shipingAddress;
            }       
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();   
        }
    }

    public function saveCartAddressAction()
    {
        try 
        {
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
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
                if(!$customerBillingAddress)
                {
                    throw new Exception("Customer billing address not saved.", 1);
                }
            }

            if($request->getPost('saveInShipingBook'))
            {
                $customer = $cart->getCustomer();
                $customerShipingAddress = $customer->getShipingAddress();
                $customerShipingAddress->setData($shipingData);
                unset($customerShipingAddress->firstName);
                unset($customerShipingAddress->lastName);
                $customerShipingAddress->save();
                if(!$customerShipingAddress)
                {
                    throw new Exception("Customer shiping address not saved.", 1);
                }
            }

            $cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartAddress',
                        'content' => $cartEditAddress,
                    ],
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
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
            $this->editBlockAction();
        }
    }

    public function savePaymentMethodAction()
    {
        try 
        {
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            $paymentData = $request->getPost('paymentMethod');
            $cart->setData(['paymentMethod' => $paymentData]);
            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("No payment method is saved.", 1);
            }

            $this->getMessage()->addMessage("Payment method saved.");
            $cartEditPaymentShiping = Ccc::getBlock('Cart_Edit_PaymentShiping')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#paymentShiping',
                        'content' => $cartEditPaymentShiping,
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
            $this->editBlockAction();
        }
    }

    public function saveShipingMethodAction()
    {
        try 
        {
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
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
            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("Shiping method not saved.", 1);
            }

            $this->getMessage()->addMessage("Shiping method saved.");
            $cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartAddress',
                        'content' => $cartEditAddress,
                    ],
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
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
            $this->editBlockAction();
        }
    }

    public function addCartItemAction()
    {
        try 
        {
            $taxAmount = null;
            $discount = null;
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            $productModel = Ccc::getModel('Product');
            $cartData = $request->getPost('cartProduct');
            $item = Ccc::getModel('Cart_Item');
            $item->cartId = $cart->cartId;

            foreach($cartData as $cartItem)
            {
                if(array_key_exists('productId',$cartItem))
                {
                    $product = $productModel->load($cartItem['productId']);
                    if($product->quantity >= $cartItem['quantity'])
                    {
                        $item->setData($cartItem);
                        $item->itemTotal = $product->price * $cartItem['quantity'];
                        $item->tax = $product->tax;
                        $item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
                        $item->discount = $product->discount * $cartItem['quantity'];
                        $saveitem = $item->save();
                        $taxAmount += ($product->price * $product->tax / 100) * $cartItem['quantity'];
                        $discount += $product->discount * $cartItem['quantity'];
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

            $this->getMessage()->addMessage("Cart Item added successfully.");
            $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartProduct',
                        'content' => $cartEditItem,
                    ],      
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
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
            $this->redirect('edit');
        }
    }

    public function deleteCartItemAction()
    {
        try 
        {
            $request = $this->getRequest();
            $itemId = $request->getRequest('id');
            $item = Ccc::getModel('Cart_Item')->load($itemId);
            $cart = $item->getCart();
            $cart->subTotal = $cart->subTotal - $item->itemTotal;
            $cart->taxAmount = $cart->taxAmount - $item->taxAmount;
            $cart->discount = $cart->discount - $item->discount;
            $cart->save();
            $result = $item->delete();
            if(!$result)
            {
                throw new Exception("Cart item not deleted.", 1);
            }

            $this->getMessage()->addMessage("Cart item deleted successfully.");
            $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartProduct',
                        'content' => $cartEditItem,
                    ],      
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }

    public function cartItemUpdateAction()
    {
        try 
        {
            $taxAmount = null;
            $discount = null;
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            $productModel = Ccc::getModel('Product');
            $cartData = $request->getPost('cartItem');
            $item = $cart->getItem();
            foreach($cartData as $cartItem)
            {
                $product = $productModel->load($cartItem['productId']);
                if($product->quantity >= $cartItem['quantity'])
                {
                    $item->setData($cartItem);
                    $item->itemTotal = $product->price * $cartItem['quantity'];
                    $item->tax = $product->tax;
                    $item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
                    $item->discount = $product->discount * $cartItem['quantity'];
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
                throw new Exception("subTotal not updated", 1);
            }

            $this->getMessage()->addMessage("Cart item updated successfully.");
            $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartProduct',
                        'content' => $cartEditItem,
                    ],
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
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
            $this->editBlockAction();
        }
    }

    public function placeOrderAction()
    {
        try 
        {
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
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

            if(!$order)
            {
                throw new Exception("Order not added.", 1);
            }
    
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
                $itemModel->discount = $product->discount;
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
            $shipinhResult = $shipingAddress->save();
            if(!$billingResult)
            {
                throw new Exception("Billing address not saved", 1);
            }

            if(!$shipinhResult)
            {
                throw new Exception("Shiping address not saved", 1);
            }

            if($order)
            {
                $cart->delete();
            }

            if($billingResult)
            {
                $billingData->delete();
            }

            if($shipinhResult)
            {
                $shipingData->delete();
            }
            
            $this->getMessage()->addMessage("Order placed successfully.");
            $this->gridBlockAction();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }
}

