<?php Ccc::loadClass('Block_Core_Grid');

class Block_Salesman_Grid extends Block_Core_Grid
{ 
	public function __construct()
	{
		parent::__construct();
	}

	public function prepareCollections()
    {
       	$this->addColumn([
		'title' => 'Salesman Id',
		'type' => 'int',
		'key' =>'salesmanId'
		],'id');
		$this->addColumn([
		'title' => 'First Name',
		'type' => 'varchar',
		'key' =>'firstName'
		],'First Name');
		$this->addColumn([
		'title' => 'Last Name',
		'type' => 'varchar',
		'key' =>'lastName'
		],'Last Name');
		$this->addColumn([
		'title' => 'Email',
		'type' => 'varchar',
		'key' =>'email'
		],'Email');
		$this->addColumn([
		'title' => 'Mobile',
		'type' => 'int',
		'key' =>'mobile'
		],'Mobile');
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
		$this->addColumn([
		'title' => 'Discount',
		'type' => 'float',
		'key' =>'discount'
		],'Discount');
		$this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'customer' ],'Edit');
		$this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'customer' ],'Delete');
		$this->addAction(['title' => 'customer','method' => 'getSalesmanCustomerUrl','class' => 'Salesman_SalesmanCustomer' ],'customer');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $salesmen = $this->getSalesmen();
        $this->setCollection($salesmen);
        return $this;
    }

    public function getSalesmen()
    {
        $salesmanModel = Ccc::getModel('Salesman');
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(salesmanId) FROM `salesman`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $salesmen = $salesmanModel->fetchAll("SELECT * FROM `salesman` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        if(!$salesmen)
        {
        	return null;
        }
        $salesmanColumn = [];
        foreach ($salesmen as $salesman) 
        {
            array_push($salesmanColumn,$salesman);
        }        
        return $salesmanColumn;
    }
}
