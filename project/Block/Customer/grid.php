<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Customer_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
	}
	public function getCustomers()
	{
		$customers = Ccc::getModel('Customer')->fetchAll("SELECT * FROM customer");
		return $customers;
	}
	public function getAddresses()
	{
		$addresses = Ccc::getModel('Customer_Address')->fetchAll("SELECT * FROM address");
		return $addresses;	
	}
}
