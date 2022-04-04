<?php Ccc::loadClass('Block_Core_Grid');

class Block_Admin_Grid extends Block_Core_Grid
{ 
	public function __construct()
	{
		parent::__construct();
	}

	public function prepareCollections()
    {
       	$this->addColumn([
		'title' => 'Admin Id',
		'type' => 'int',
		'key' =>'adminId'
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
		$this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'admin' ],'Edit');
		$this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'admin' ],'Delete');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $admins = $this->getAdmins();
        $this->setCollection($admins);
        return $this;
    }

    public function getAdmins()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $adminModel = Ccc::getModel('Admin');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(adminId) FROM `admin`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $admins = $adminModel->fetchAll("SELECT * FROM `admin` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getEndLimit()}");
        if(!$admins)
        {
        	return null;
        }
        $adminColumn = [];
        foreach ($admins as $admin) 
        {
            array_push($adminColumn,$admin);
        }        
        return $adminColumn;
    }
}