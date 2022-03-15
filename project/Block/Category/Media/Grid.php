<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Category_Media_Grid extends Block_Core_Template
{
    protected $pager = null;

    public function __construct()
    {
        $this->setTemplate("view/category/media/grid.php");
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
        $categoryId = $request->getRequest('id');
        $mediaModel = Ccc::getModel('Category_Media');
        $category = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `categoryId` = $categoryId ");
        return $category;
    }

    public function selected($mediaId,$column)
    {
        $request = Ccc::getFront()->getRequest();
        $categoryId = $request->getRequest('id');
        $categoryModel = Ccc::getModel('Category');
        $select = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `$column` = '$mediaId'");
        if($select)
        {
            return 'checked';
        }
    }
}
