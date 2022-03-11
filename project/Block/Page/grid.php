<?php Ccc::loadClass('Block_Core_Template');
class Block_Page_Grid extends Block_Core_Template
{
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/page/grid.php');
	}

	public function getPager()
	{
		return $this->pager;
	}

	public function setPager()
	{
		$this->pager = $pager;
		return $this;
	}
	
	public function getPages()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $pagerModel = Ccc::getModel('Core_Pager');
        $this->pager = $pagerModel;
        $pageModel = Ccc::getModel('Page');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(pageId) FROM `page`");
        $pagerModel->execute($totalCount, $page);
        $query = "SELECT * FROM `page` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $pages = $pageModel->fetchAll($query);
        return $pages;
	}
}
