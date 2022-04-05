<?php Ccc::loadClass('Block_Core_Grid');

class Block_Product_Grid extends Block_Core_Grid{ public function __construct
(){ parent::__construct(); $this->prepareCollections(); }

	public function prepareCollections()
    {
       	$this->addColumn([
		'title' => 'Product Id',
		'type' => 'int',
		'key' =>'productId'
		],'id');
		$this->addColumn([
		'title' => 'Name',
		'type' => 'varchar',
		'key' =>'name'
		],'Name');
		$this->addColumn([
		'title' => 'Base Image',
		'type' => 'int',
		'key' =>'base'
		],'Base Image');
		$this->addColumn([
		'title' => 'Thumb Image',
		'type' => 'int',
		'key' =>'thumb'
		],'Thumb Image');
		$this->addColumn([
		'title' => 'Small Image',
		'type' => 'int',
		'key' =>'small'
		],'Small Image');
		$this->addColumn([
		'title' => 'MSP',
		'type' => 'float',
		'key' =>'msp'
		],'msp');
		$this->addColumn([
		'title' => 'Cost Price',
		'type' => 'float',
		'key' =>'costPrice'
		],'Cost Price');
		$this->addColumn([
		'title' => 'Quantity',
		'type' => 'int',
		'key' =>'quantity'
		],'Quantity');
		$this->addColumn([
		'title' => 'Tax',
		'type' => 'float',
		'key' =>'tax'
		],'Tax');
		$this->addColumn([
		'title' => 'Discount',
		'type' => 'float',
		'key' =>'discount'
		],'discount');
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
		$this->addAction(['title' => 'edit','method' => 'getEditUrl','class' => 'product' ],'Edit');
		$this->addAction(['title' => 'delete','method' => 'getDeleteUrl','class' => 'product' ],'Delete');
        $this->prepareCollectionContent();
    }

    public function prepareCollectionContent()
    {
        $products = $this->getProducts();
        $this->setCollection($products);
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
        $products = $productModel->fetchAll("SELECT * FROM `product` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getPerPageCount()}");
        if(!$products)
        {
        	return null;
        }
        
        $productColumn = [];
        foreach ($products as $product) 
        {
            array_push($productColumn,$product);
        }        
        return $productColumn;
    }

    public function getMedia($mediaId)
	{
		$mediaModel=Ccc::getModel('Product_Media');
		$query="SELECT * FROM `product_media` WHERE `mediaId` = {$mediaId}";
		$media = $mediaModel->fetchAll($query);
		return $media[0]->getData();
	}
}
