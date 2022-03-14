<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Customer_Grid extends Block_Core_Template 
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/customer/grid.php');
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
		
	public function getCustomers()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $customerModel = Ccc::getModel('Customer');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(`customerId`) FROM `customer`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $query = "SELECT * FROM `customer` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $customers = $customerModel->fetchAll($query);
        return $customers;
	}

	public function getAddresses()
	{
        $addressModel = Ccc::getModel('Customer_Address');
        $addresses = $addressModel->fetchAll("SELECT * FROM address");
        return $addresses;  
	}
}
