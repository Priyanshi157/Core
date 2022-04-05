<?php Ccc::loadClass('Block_Core_Grid');

class Block_Vendor_Grid extends Block_Core_Grid 
{ 
	public function __construct()
	{
		parent::__construct();
	}

	public function prepareCollections()
    {
       	$this->addColumn([
		'title' => 'Vendor Id',
		'type' => 'int',
		'key' =>'vendorId'
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
		$this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'customer' ],'Edit');
		$this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'customer' ],'Delete');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $vendors = $this->getVendors();
        $this->setCollection($vendors);
        return $this;
    }

    public function getVendors()
    {
        $vendorModel = Ccc::getModel('Vendor');
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(vendorId) FROM `vendor`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $vendors = $vendorModel->fetchAll("SELECT * FROM `vendor` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        if(!$vendors)
        {
        	return null;
        }
        
        $vendorColumn = [];
        foreach ($vendors as $vendor) 
        {
            $address = null; 
            foreach($vendor->getAddress()->getData() as $key => $value)
            {
                if($key != 'addressId' && $key != 'customerId')
                {
                    $address .= $key." : ".$value."<br>";
                }
            }
            $vendor->setData(['address' => $address]);
            array_push($vendorColumn,$vendor);
        }
        return $vendorColumn;
    }
}
