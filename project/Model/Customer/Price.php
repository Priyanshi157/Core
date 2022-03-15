<?php Ccc::loadClass('Model_Core_Row');

class Model_Customer_Price extends Model_Core_Row
{
	protected $customer = null;
	protected $salesman = null;
	
	public function __construct()
	{
		$this->setResourceClassName('Customer_Price_Resource');
		parent::__construct();
	}

	public function setCustomer(Model_Customer $customer)
	{
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer($reload=false)
	{
		$customerModel = Ccc::getModel('Customer');
		if(!$this->customerId)
		{
			return null;
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

	public function setSalesman(Model_Salesman $salesman)
	{
		$this->salsesman = $salesman;
		return $this;
	}

	public function getSalesman($reload=false)
	{
		$salsesmanModel = Ccc::getModel('Salesman');
		$customerModel = Ccc::getModel('Customer');
		if($this->salesman && !$reload)
		{
			return $this->salesman;
		}

		$customer = $this->getCustomer();
		if(!($salesmanId == $customer->salesmanId))
		{
			return null;
		}

		$salesman = $customer->fetchRow("SELECT * FROM `salesman` WHERE `salesmanId` = {$this->customer->salesmanId}");
		if(!$salesman)
		{
			return $salesmanModel;
		}

		$this->setSalesman($salesman);
		return $this->salesman;
	}
}
