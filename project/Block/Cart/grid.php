<?php Ccc::loadClass('Block_Core_Grid');

class Block_Cart_Grid extends Block_Core_Grid
{ 
    public function __construct()
    {
        parent::__construct();
    }

    public function prepareCollections()
    {
        $this->addColumn([
        'title' => 'Order Id',
        'type' => 'int',
        'key' =>'orderId'
        ],'id');
        $this->addColumn([
        'title' => 'Customer Id',
        'type' => 'int',
        'key' =>'customerId'
        ],'id');
        $this->addColumn([
        'title' => 'First Name',
        'type' => 'varchar',
        'key' =>'firstName'
        ],'firstName');
        $this->addColumn([
        'title' => 'Last Name',
        'type' => 'varchar',
        'key' =>'lastName'
        ],'lastName');
        $this->addColumn([
        'title' => 'Email',
        'type' => 'varchar',
        'key' =>'email'
        ],'email');
        $this->addColumn([
        'title' => 'Mobile',
        'type' => 'int',
        'key' =>'mobile'
        ],'Mobile');
        $this->addColumn([
        'title' => 'Grand Total',
        'type' => 'float',
        'key' =>'grandTotal'
        ],'Grand Total');
        $this->addAction(['title' => 'View Order','method' => 'getEditUrl','class' => 'order' ],'Edit');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $orders = $this->getOrders();
        $this->setCollection($orders);
        return $this;
    }

    public function getCart()
    {
        $cartModel = Ccc::getModel('Cart');
        $query = "SELECT * FROM `cart` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $cart = $cartModel->fetchAll($query);
        return $cart;
    }

    public function getOrders()
    {
        $orderModel = Ccc::getModel("Order");
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('orderId') FROM `order_data`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $orders = $orderModel->fetchAll("SELECT * FROM `order_data` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        if(!$orders)
        {
            return null;
        }
        $orderColumn = [];
        foreach ($orders as $order) 
        {
            array_push($orderColumn,$order);
        }        
        return $orderColumn;

    }
}
