<?php
Ccc::loadClass('Model_Core_Row');
class Model_Cart extends Model_Core_Row
{
	protected $item;
	protected $customer;
	protected $billingAdress;
	protected $shipingAddress;
	protected $items;
	public function __construct()
	{
		$this->setResourceClassName('Cart_Resource');
		parent::__construct();
	}

	public function getItem($reload = false)
	{
		$itemModel = Ccc::getModel('Cart_Item');
		if(!$this->cartId)
		{
			return $itemModel;
		}
		if($this->item && !$reload)
		{
			return $this->item;
		}

		$item = $itemModel->fetchRow("SELECT * FROM `cart_item` WHERE `cartId` = {$this->cartId}");
		if(!$item)
		{
			return $itemModel;
		}

		$this->setItem($item);
		return $this->item;
	}

	public function setItem($item)
	{
		$this->item = $item;
		return $this;
	}

	public function getCustomer($reload = false)
	{
		$customerModel = Ccc::getModel('Customer');
		if(!$this->customerId)
		{
			return $customerModel;
		}

		if($this->customer && !$reload)
		{
			return $this->customer;
		}

		$customer = $customerModel->fetchRow("SELECT * FROM `customer` WHERE `customerId` = {$this->customerId}");
		if(!$customer)
		{
			return $customerModel;
		}
		$this->setCustomer($customer);
		return $this->customer;
	}

	public function setCustomer(Model_Customer $customer)
	{
		$this->customer = $customer;
		return $this;
	}

	public function getBillingAddress($reload = false)
	{
		$addressModel = Ccc::getModel('Cart_Address');
		if(!$this->cartId)
		{
			return $addressModel;
		}

		if($this->billingAddress && !$reload)
		{
			return $this->billingAddress;
		}

		$address=$addressModel->fetchRow("SELECT * FROM `cart_address` WHERE `cartId` = {$this->cartId} AND `billing` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setBillingAddress($address);
		return $this->billingAddress;
	}

	public function setBillingAddress(Model_Cart_Address $address)
	{
		$this->billingAddress = $address;
		return $this;
	}

	public function getShipingAddress($reload = false)
	{
		$addressModel = Ccc::getModel('Cart_Address');
		if(!$this->cartId)
		{
			return $addressModel;
		}

		if($this->shipingAddress && !$reload)
		{
			return $this->shipingAddress;
		}
		
		$address=$addressModel->fetchRow("SELECT * FROM `cart_address` WHERE `cartId` = {$this->cartId} AND `shiping` = 1");
		if(!$address)
		{
			return $addressModel;
		}

		$this->setShipingAddress($address);
		return $this->shipingAddress;
	}

	public function setShipingAddress(Model_Cart_Address $address)
	{
		$this->shipingAddress = $address;
		return $this;
	}

	public function getItems($reload = false)
	{
		$itemModel = Ccc::getModel('Cart_Item');
		if(!$this->cartId)
		{
			return $itemModel;
		}

		if($this->items && !$reload)
		{
			return $this->items;
		}

		$items=$itemModel->fetchAll("SELECT * FROM `cart_item` WHERE `cartId` = {$this->cartId}");
		if(!$items)
		{
			return $itemModel;
		}
		$this->setItems($items);
		return $this->item;
	}

	public function setItems($items)
	{
		$this->item = $items;
		return $this;
	}
}