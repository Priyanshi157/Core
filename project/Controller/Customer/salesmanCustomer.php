<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php

class Controller_Salesman_SalesmanCustomer extends Controller_Core_Action
{
	public function gridAction()
	{
        $content = $this->getLayout()->getContent();
        $salesmanGrid = Ccc::getBlock("Salesman_SalesmanCustomer_Grid");
        $content->addChild($salesmanGrid);
        $menu = Ccc::getBlock('Core_Layout_Menu');
        $message = Ccc::getBlock('Core_Layout_Message');
        $header = $this->getLayout()->getHeader()->addChild($menu,'menu')->addChild($message,'message');
        $this->renderLayout();
	}

    public function saveAction()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = $this->getRequest();
        $salesmanId = $request->getRequest('id');
        if($request->isPost())
        {
            $customerData = $request->getPost('customer');
            print_r($customerData);
            exit;
            $customerModel->salesmanId = $salesmanId;
            foreach($customerData as $customer)
            {
                $customerModel->customerId = $customer;
                print_r($customerModel);
                //$result = $customerModel->save(); 
                // if(!$result)
                // {
                //     $this->getMessage()->addMessage("Unable to add Data.");
                //     throw new Exception("Error Processing Request", 1);
                // }
            }
            exit;
            $this->redirect($this->getView()->getUrl('grid','Salesman_SalesmanCustomer',[],true));
        }
    }
}