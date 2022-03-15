<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Product_Media_Grid extends Block_Core_Template
{
    protected $pager = null;
    public function __construct()
    {
        $this->setTemplate("view/product/media/grid.php");
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

    public function getMedias()
    {
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        $mediaModel = Ccc::getModel('Product_Media');
        $medias = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `productId` = $productId ");
        return $medias;
    }
    
    public function selected($mediaId,$column)
    {
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        $productModel = Ccc::getModel('Product');
        $select = $productModel->fetchAll("SELECT * FROM `product` WHERE `$column` = '$mediaId'");
        if($select)
        {
            return 'checked';
        }
    }
}
