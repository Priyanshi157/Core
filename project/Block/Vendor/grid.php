<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Vendor_Grid extends Block_Core_Template 
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/vendor/grid.php');
	}

	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager($this->pager);
		}
		return $this->pager;
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}
	
	public function getVendors()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $vendorModel = Ccc::getModel('Vendor');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(`vendorId`) FROM `vendor`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $query = "SELECT * FROM `vendor` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $vendors = $vendorModel->fetchAll($query);
        return $vendors;
	}

	public function getAddresses()
	{
		$addresses = Ccc::getModel('Vendor_Address')->fetchAll("SELECT * FROM vendor_address");
		return $addresses;
	}
}
