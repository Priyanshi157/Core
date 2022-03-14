<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Config_Grid extends Block_Core_Template
{ 
    protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/config/grid.php');
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

   	public function getConfigs()
	{
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $configModel = Ccc::getModel('Config');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(`configId`) FROM `config`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $query = "SELECT * FROM `config` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $configs = $configModel->fetchAll($query);
        return $configs;
	}
}