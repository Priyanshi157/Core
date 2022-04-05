<?php Ccc::loadClass("Block_Core_Template");

class Block_Cart_Grid extends Block_Core_Template
{
    protected $pager = null;    
    public function __construct()
    {
        $this->setTemplate("view/cart/grid.php");
    }

    public function getCart()
    {
        $request = Ccc::getModel('Core_Request');
        $cartModel = Ccc::getModel('Cart');
        $pagerModel = Ccc::getModel('Core_Pager');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);
        $totalCount = $pagerModel->getAdapter()->fetchOne("SELECT COUNT('cartId') FROM `cart`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $carts = $cartModel->fetchAll("SELECT * FROM `cart` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        return $carts;
    }

    public function setPager($pager)
    {
        $this->pager = $pager;
        return $this;
    }

    public function getPager()
    {
        if(!$this->pager)
        {
            $this->setPager(Ccc::getModel('Core_Pager'));
        }
        return $this->pager;
    }

    public function getOrders()
    {
        $orderModel = Ccc::getModel("Order");
        $pagerModel = Ccc::getModel('Core_Pager');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('orderId') FROM `order_data`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $orders = $orderModel->fetchAll("SELECT * FROM `order_data` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $this->setPager($pagerModel);
        return $orders;
    }
}
