<?php Ccc::loadClass('Model_Core_Row');

class Model_Customer extends Model_Core_Row
{
	protected $billingAddress;
	protected $shipingAddress;

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 2;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName('Customer_Resource');
		parent::__construct();
	}

	public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];

		if(!$key)
		{
			return $statuses;
		}

		if(array_key_exists($key, $statuses))
		{
			return $statuses[$key];
		}
		return $statuses[self::STATUS_DEFAULT];
	}

	public function getBillingAddress($reload=false)
	{
		$addressModel = Ccc::getModel('Customer_Address');
		if(!$this->customerId)
		{
			return $addressModel;
		}
		if($this->billingAddress && !$reload)
		{
			return $this->billingAddress;
		}

		$address = $addressModel->fetchRow("SELECT * FROM `address` WHERE `customerId` = {$this->customerId } AND `billing` = 1 ");
		if(!$address)
		{
			return $addressModel;
		}
		
		$this->setBillingAddress($address);
		return $address;
	}

	public function setBillingAddress(Model_Customer_Address $address)
	{
		$this->billingAddress = $address;
		return $this;
	}

	public function getShipingAddress($reload=false)
	{
		$addressModel = Ccc::getModel('Customer_Address');
		if(!$this->customerId)
		{
			return $addressModel;
		}

		if($this->shipingAddress && !$reload)
		{
			return $this->shipingAddress;
		}
		
		$address = $addressModel->fetchRow("SELECT * FROM `address` WHERE `customerId` = {$this->customerId } AND `shiping` = 1 ");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setShipingAddress($address);
		return $address;
	}

	public function setShipingAddress(Model_Customer_Address $address)
	{
		$this->shipingAddress = $address;
		return $this;
	}

    public function getActionUrl($action)
	{
		if($action['method']=='getPriceUrl')
		{
			return Ccc::getModel('Core_View')->getUrl('grid',$action['class'],['id'=>$this->customerId],true);
		}
		return Ccc::getModel('Core_View')->getUrl($action['title'],$action['class'],['id'=>$this->customerId],true);
	}

	public function getEditUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('edit','customer',['id'=>$this->customerId]);
	}

	public function getDeleteUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('delete','customer',['id'=>$this->customerId]);
	}

	public function getPriceUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('grid','customer_price',['id' => $this->customerId]);
	}
}