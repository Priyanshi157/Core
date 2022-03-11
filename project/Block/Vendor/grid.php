<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Vendor_Grid extends Block_Core_Template {

	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}
	public function getVendors()
	{
		$vendors = Ccc::getModel('Vendor')->fetchAll("SELECT * FROM vendor");
		return $vendors;
	}
	public function getAddresses()
	{
		$addresses = Ccc::getModel('Vendor_Address')->fetchAll("SELECT * FROM vendor_address");
		return $addresses;	
	}
}
