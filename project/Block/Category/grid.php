<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Category_Grid extends Block_Core_Template
{ 
    protected $pager = null;

	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
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
    
    public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1)
         {
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `categoryId` = '$path1' ");
            if($path1 != $categoryId)
            {
                $finalPath .= $category->name ."=>";
            }
            else
            {
                $finalPath .= $category->name;
            }
        }
        return $finalPath;
    }

    public function getMedia($mediaId)
    {
        $mediaModel = Ccc::getModel('category');
        $media = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `mediaId` = '$mediaId'");
        return $media[0]->getData();
    }

    public function getCategories()
    {
        $request = Ccc::getModel('Core_Request');
        $page = (int)$request->getRequest('p', 1);
        $ppr = (int)$request->getRequest('ppr',10);
        $pagerModel = Ccc::getModel('Core_Pager');
        $categoryModel = Ccc::getModel('category');
        $totalCount = $this->getAdapter()->fetchOne("SELECT count(`categoryId`) FROM `category` ORDER BY `path`");
        $pagerModel->execute($totalCount, $page, $ppr);
        $this->setPager($pagerModel);
        $query = "SELECT * FROM `category` LIMIT {$pagerModel->getStartLimit()} , {$pagerModel->getEndLimit()}";
        $categories = $categoryModel->fetchAll($query);
        return $categories;
    }
}