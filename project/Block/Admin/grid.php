<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Admin_Grid extends Block_Core_Template
{ 
    protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/admin/grid.php');
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

   	public function getAdmins()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $adminModel = Ccc::getModel('Admin');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(`adminId`) FROM `admin`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $query = "SELECT * FROM `admin` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $admins = $adminModel->fetchAll($query);
        return $admins;
	}
}