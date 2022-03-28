<?php Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Admin_Grid_Collection extends Block_Core_Grid_Collection
{
    public function __construct()
    {
        $this->setCurrentCollection('personal');
        parent::__construct();
    }

    public function prepareCollections()
    {
        $this->addCollection([
            'header' => ['AdminId','First Name','Last Name','Email','Status','CreatedAt','updatedAt'],
            'action' => $this->getActions(),
            'url' => $this->getUrl(null,null,['Collection' => 'personal'])
        ],'personal');
        $this->prepareCollectionContent();
    }

    public function prepareCollectionContent()
    {
        $admins = $this->getAdmins();
        $array=[];
        foreach($admins as $admin)
        {
            $array1=[]; 
            foreach($admin->getData() as $key => $value)
            {
                $array1[]=$value;
            }
            array_push($array,$array1);        
        }
        $this->setColumns($array);
        return $this;
    }

    public function getAdmins()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);

        $pagerModel = Ccc::getModel('Core_Pager');
        
        $adminModel = Ccc::getModel('Admin');   
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(adminId) FROM `admin`");
        
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
        $admins = $adminModel->fetchAll("SELECT `adminId`,`firstName`,`lastName`,`email`,`status`,`createdAt`,`updatedAt` FROM `admin` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        $this->setPagerModel($pagerModel);
        return $admins;

    }
}