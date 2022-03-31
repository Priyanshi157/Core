<?php Ccc::loadClass('Block_Core_Grid');

class Block_Config_Grid extends Block_Core_Grid
{ 
    public function __construct()
    {
        parent::__construct();
    }

    public function prepareCollections()
    {
        $this->addColumn([
        'title' => 'Config Id',
        'type' => 'int',
        'key' =>'configId'
        ],'id');
        $this->addColumn([
        'title' => 'Name',
        'type' => 'varchar',
        'key' =>'name'
        ],'name');
        $this->addColumn([
        'title' => 'Code',
        'type' => 'varchar',
        'key' =>'code'
        ],'code');
        $this->addColumn([
        'title' => 'Value',
        'type' => 'varchar',
        'key' =>'value'
        ],'Value');
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
        $this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'config' ],'Edit');
        $this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'config' ],'Delete');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $configs = $this->getConfigs();
        $this->setCollection($configs);
        return $this;
    }

    public function getConfigs()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $configModel = Ccc::getModel('Config');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(pageId) FROM `page`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $configs = $configModel->fetchAll("SELECT * FROM `config` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        if(!$configs)
        {
            return null;
        }
        $configColumn = [];
        foreach ($configs as $config) 
        {
            array_push($configColumn,$config);
        }        
        return $configColumn;
    }
}
