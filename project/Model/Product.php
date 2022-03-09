<?php Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row
{
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 2;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

	public function __construct()
	{
		$this->setResourceClassName('Product_Resource');
		parent::__construct();
	}

	public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];

		if(!$key)
		{
			return $statuses;
		}

		if(array_key_exists($key, $statuses))
		{
			return $statuses[$key];
		}
		return $statuses[self::STATUS_DEFAULT];
	}

	public function saveCategories(array $categoryIds)
	{
		$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
		$categoryProduct = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `productId` = '$this->productId' ");
		foreach($categoryProduct as $category)
		{
			if(in_array($category->categoryId,$categoryIds['exists']))
			{
				$categoryProductModel->load($category->entityId)->delete();
			}
		}

		foreach($categoryIds['new'] as $categoryId)
		{
			$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
			$categoryProductModel->productId = $this->productId;
			$categoryProductModel->categoryId = $categoryId;
			$categoryProductModel->save();
		}
	}
}
?>