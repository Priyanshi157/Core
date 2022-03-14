<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Customer_Price_Grid extends Block_Core_Template
{
    protected $pager = null;
    public function __construct()
    {
        $this->setTemplate("view/customer/price/grid.php");
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

    public function getProducts()
    {
        $request = Ccc::getFront()->getRequest();
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);
        $pagerModel = Ccc::getModel('Core_Pager');
        $customerId = $request->getRequest('id');
        $productModel = Ccc::getModel('product');
        $customerModel = Ccc::getModel('customer');
        $customer = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `customerId` = {$customerId} AND `salesmanId` IS NOT NULL");
        if(!$customer)
        {
            return $productModel->getData();
        }

        $totalCount = $this->getAdapter()->fetchOne("SELECT count(productId) FROM `product` WHERE `status` = '1'");
        $pagerModel->execute($totalCount,$page,$ppr);
        $this->setPager($pagerModel);
        $products = $productModel->fetchAll("SELECT * FROM `product` WHERE `status` = '1' LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}");
        return $products;
    }

    public function getCustomerPrice($productId)
    {
        $request = Ccc::getFront()->getRequest();
        $customerId = $request->getRequest('id');
        $customerPriceModel = Ccc::getModel('Customer_Price');
        $discount = $customerPriceModel->fetchAll("SELECT * FROM `customer_price` WHERE `productId` = '$productId' AND `customerId` = '$customerId' ");
        if(!$discount)
        {
            return null;
        }
        return $discount[0]->price;
    }

    public function getSalesmanPrice($productId)
    {
        $request = Ccc::getFront()->getRequest();
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',20);
        $pagerModel = Ccc::getModel('Core_Pager');
        $customerId = $request->getRequest('id');
        $productModel = Ccc::getModel('product');
        $salesmanModel = Ccc::getModel('salesman');
        $customerModel = Ccc::getModel('customer');
        $customer = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `customerId` = {$customerId}");
        if($customer)
        {
            $salesman = $salesmanModel->fetchAll("SELECT * FROM `salesman` WHERE `salesmanId` = {$customer[0]->salesmanId}");
            if($salesman)
            {
                $product = $productModel->fetchAll("SELECT * FROM `product` WHERE `productId` = {$productId}");
                return $product[0]->price - $product[0]->price * $salesman[0]->discount/100;
            }
        }
    }
}
