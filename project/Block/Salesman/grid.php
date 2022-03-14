<?php Ccc::loadClass('Block_Core_Template');
class Block_Salesman_Grid extends Block_Core_Template
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/salesman/grid.php');
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

	public function getSalesMen()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $salesmanModel = Ccc::getModel('Salesman');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(`salesmanId`) FROM `salesman`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $query = "SELECT * FROM `salesman` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $salesmen = $salesmanModel->fetchAll($query);
        return $salesmen;
	}
}
