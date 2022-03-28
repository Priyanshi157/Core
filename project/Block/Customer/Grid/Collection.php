<?php Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Customer_Grid_Collection extends Block_Core_Grid_Collection
{
    public function __construct()
    {
        $this->setCurrentCollection('customer');
        parent::__construct();
    }

    public function prepareCollections()
    {
        $this->addCollection([
            'header' => ['CustomerId','First Name','Last Name','Email','Mobile','Status','CreatedAt','UpdatedAt','Billing Address','Shiping Address'],
            'action' => $this->getActions(),
            'url' => $this->getUrl(null,null,['Collection' => 'customer'])
        ],'customer');
        $this->prepareCollectionContent();
    }

    public function prepareCollectionContent()
    {
        $customers = $this->getCustomers();
        foreach ($customers as $customer) 
        {
            $customer->setData(['billing'=>$customer->getBillingAddress()]);
            $customer->setData(['shiping'=>$customer->getShipingAddress()]);
        }
        $array=[];
        foreach($customers as $customer)
        {
            $customer->status = $customer->getStatus($customer->status);
            $customerData = [];   
            foreach($customer->getData() as $key => $value)
            {
                $customerData[]=$value;
                if($key == 'billing' || $key == 'shiping')
                {
                    $address = null;
                    foreach ($value->getData() as $k => $v) 
                    {
                        if($k != 'billing' && $k != 'shipping' && $k != 'addressId' && $k != 'customerId')
                        {
                            $address .= $k." => ".$v."<br>";
                        }
                    }
                    array_push($customerData,$address);
                }
            }
            unset($customerData[8]);
            unset($customerData[10]);
            array_push($array,$customerData);        
        }
        $this->setColumns($array);
        return $this;
    }

    public function getCustomers()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $customerModel = Ccc::getModel('Customer');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(`customerId`) FROM `customer`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $customers = $customerModel->fetchAll("SELECT `customerId`,`firstName`,`lastName`,`email`,`mobile`,`status`,`createdAt`,`updatedAt` FROM `customer` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        $this->setPagerModel($pagerModel);
        return $customers;
    }
}