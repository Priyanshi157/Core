<?php Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row
{
	protected $media = null;
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

	public function saveCategories($categoryIds)
	{
		$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
		$categoryProduct = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `productId` = '$this->productId' ");
		if(!$categoryIds || !array_key_exists('exists',$categoryIds))
		{
			$categoryIds['exists'] = [];
		}
		foreach($categoryProduct as $category)
		{
			if(!in_array($category->categoryId, $categoryIds['exists']))
			{
				$categoryProductModel->load($category->entityId)->delete();
			}
		}
		if(array_key_exists('new',$categoryIds))
		{
			foreach($categoryIds['new'] as $categoryId)
			{
				$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
				$categoryProductModel->productId = $this->productId;
				$categoryProductModel->categoryId = $categoryId;
				$categoryProductModel->save();
			}
		}
	}

	public function setCategory($category)
	{
		$this->category = $category;
		return $this;
	}
	
	public function getBase()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->base)
		{
			return null;
		}
		$base = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->base}");
		if(!$base)
		{
			return $mediaModel;
		}

		return $base;
	}

	public function getSmall()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->small)
		{
			return null;
		}
		$small = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->small}");
		if(!$small)
		{
			return $mediaModel;
		}

		return $small;
	}

	public function getThumb()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->thumb)
		{
			return null;
		}
		$thumb = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `mediaId` = {$this->thumb}");
		if(!$thumb)
		{
			return $mediaModel;
		}

		return $thumb;
	}
	
	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->media)
		{
			return null;
		}
		if($this->media && !$reload)
		{
			return $this->media;
		}
		$media = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `productId` = {$this->productId}");
		if(!$media)
		{
			return null;
		}
		$this->setMedia($media);

		return $this->media;
	}
	public function setMedia(Model_Product_Media $media)
	{
		$this->media =$media;
		return $this;
	}

}
