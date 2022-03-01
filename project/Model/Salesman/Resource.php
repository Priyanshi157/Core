<?php Ccc::loadClass('Model_Core_Row_Resource');

class Model_Salesman_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('Salesman')->setPrimaryKey('salesmanId');
		parent::__construct();
	}
}
?>