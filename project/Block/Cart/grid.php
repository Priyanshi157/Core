<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Cart_Grid extends Block_Core_Template
{ 
    protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/cart/grid.php');
	}

    public function getPager()
    {
        if(!$this->pager)
        {
            $this->setPager($this->pager);
        }
        return $this->pager;
    }

    public function setPager($pager)
    {
        $this->pager = $pager;
        return $this;
    }

   	public function getCart()
	{
	 	$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $cartModel = Ccc::getModel('Cart');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(`cartId`) FROM `cart`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $query = "SELECT * FROM `cart` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $cart = $cartModel->fetchAll($query);
        return $cart;
	}
}