<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Page extends Model_Core_Row
{
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 2;
	const STATUS_ENABLED_LBL = 'Active';
	const STATUS_DISABLED_LBL = 'Inactive';

	public function __construct()
	{
		$this->setResourceClassName('Page_Resource');
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

	public function getActionUrl($action)
	{
		return Ccc::getModel('Core_View')->getUrl($action['title'],$action['class'],['id'=>$this->pageId],true);
	}
}