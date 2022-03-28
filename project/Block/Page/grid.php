<?php Ccc::loadClass('Block_Core_Grid');

class Block_Page_Grid extends Block_Core_Grid
{ 
	public function __construct()
	{
		parent::__construct();
	}

	public function prepareCollections()
    {
       	$this->addColumn([
		'title' => 'Page Id',
		'type' => 'int',
		'key' =>'pageId'
		],'Page Id');
		$this->addColumn([
		'title' => 'Name',
		'type' => 'varchar',
		'key' =>'name'
		],'Name');
		$this->addColumn([
		'title' => 'Code',
		'type' => 'varchar',
		'key' =>'code'
		],'code');
		$this->addColumn([
		'title' => 'Content',
		'type' => 'varchar',
		'key' =>'content'
		],'Content');
		$this->addColumn([
		'title' => 'Status',
		'type' => 'int',
		'key' =>'status'
		],'Status');
		$this->addColumn([
		'title' => 'Created Date',
		'type' => 'datetime',
		'key' =>'createdAt'
		],'Created Date');
		$this->addColumn([
		'title' => 'Updated Date',
		'type' => 'datetime',
		'key' =>'updatedAt'
		],'Updated Date');
		$this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'page' ],'Edit');
		$this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'page' ],'Delete');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $pages = $this->getPages();
        $this->setCollection($pages);
        return $this;
    }
	
	public function getPages()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $pageModel = Ccc::getModel('Page');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(pageId) FROM `page`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $pages = $pageModel->fetchAll("SELECT * FROM `page` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        if(!$pages)
        {
        	return null;
        }
        $pageColumn = [];
        foreach ($pages as $page) 
        {
            array_push($pageColumn,$page);
        }        
        return $pageColumn;
    }
}
