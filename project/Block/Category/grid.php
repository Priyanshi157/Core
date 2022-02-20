<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Category_Grid extends Block_Core_Template
{ 
	public function __construct()
	{
		$this->setTemplate('view/category/grid.php');
	}

   	public function getCategories()
   	{
   		$categoryModel = Ccc::getModel('Category');
		$categories = $categoryModel->fetchAll("SELECT * FROM category ORDER BY categoryPath ASC");
		return $categories;
   	}

   	public function getDataByPath()
    {
        $adapter = new Model_Core_Adapter();

        $category = [];
        $categoryIdName = $adapter->fetchPairs('SELECT categoryId , name FROM category ORDER BY categoryPath ASC');
        $categoryIdPath = $adapter->fetchPairs('SELECT categoryId , categoryPath FROM category ORDER BY categoryPath ASC');
        foreach ($categoryIdPath as $categoryId => $path) 
        {
            $idArray = explode("/", $path);
            $temp=[];
            foreach($idArray as $key => $Id)
            {
                if(array_key_exists($Id, $categoryIdName)):
                    array_push($temp ,$categoryIdName[$Id]);
                endif;
            }
            $pathArray = implode("/", $temp);
            $category[$categoryId] = $pathArray;   
        }
        return($category);
    }
}