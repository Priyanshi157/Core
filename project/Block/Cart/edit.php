<?php
Ccc::loadClass('Block_Core_Template');
class Block_Cart_Edit extends Block_Core_Template   
{ 
    public function __construct()
    {
        $this->setTemplate('view/cart/edit.php');
    }

    public function getCart()
    {
        $cart = $this->cart;
        return $cart;
    }

    public function getProducts()
    {
        $productModel = Ccc::getModel('Product');
        $cartId = !($this->cart->item->cartId) ? null : $this->cart->item->cartId;
        if($cartId)
        {
            $products = $productModel->fetchAll("SELECT * FROM `product` WHERE `productId` NOT IN (SELECT `productId` FROM `cart_item` WHERE `cartId` = $cartId)");
        }
        else
        {
            $products = $productModel->fetchAll("SELECT * FROM `product` WHERE `status` = 1");            
        }
        return $products;
    }

    public function getCustomers()
    {
        $customerModel = Ccc::getModel('Customer');
        $customer = $customerModel->fetchAll("SELECT * FROM `customer`");
        return $customer;
    }

    public function getItems()
    {
        $itemModel = Ccc::getModel('Cart_Item');
        $cartId = !($this->cart->item->cartId) ? null : $this->cart->item->cartId;
        if($cartId)
        {
            $items = $itemModel->fetchAll("SELECT * FROM `cart_item` WHERE `cartId` = {$cartId} ");
            return $items;
        }
        return null;
    }

    public function getTotal()
    {
        $itemModel = Ccc::getModel('Cart_Item');
        $cartId = !($this->cart->item->cartId) ? null : $this->cart->item->cartId;
        if($cartId)
        {
            $items = $this->getAdapter()->fetchOne("SELECT sum(`itemTotal`) FROM `cart_item` WHERE `cartId` = {$cartId} ");
            return $items;
        }
        return null;
    }

    public function getTax($cartId)
    {
        if($cartId)
        {
            $tax =$this->getAdapter()->fetchOne("SELECT sum(ci.itemTotal * p.tax / 100) FROM `cart_item` as ci JOIN `product` as p ON ci.productId = p.productId WHERE ci.cartId = {$cartId}");
            return $tax;    
        }
        return null;
    }
}