<?php Ccc::loadClass('Block_Core_Template'); 

class Block_Product_Grid extends Block_Core_Template 
{	
	protected $pager = null;
	public function __construct()
	{
		$this->setTemplate('view/product/grid.php');
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
		$request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $productModel = Ccc::getModel('Product');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(`productId`) FROM `product`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $query = "SELECT * FROM `product` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $products = $productModel->fetchAll($query);
        return $products;
	}

	public function getMedia($mediaId)
	{
		$mediaModel=Ccc::getModel('Product_Media');
		$query="SELECT * FROM `product_media` WHERE `mediaId` = {$mediaId}";
		$media = $mediaModel->fetchAll($query);
		return $media[0]->getData();
	}
	
}
