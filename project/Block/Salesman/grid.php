<?php Ccc::loadClass('Block_Core_Template');
class Block_Salesman_Grid extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/salesman/grid.php');
	}

	public function getsalesmen()
	{
		$salesmanModel = Ccc::getModel('salesman');
		$salesmen = $salesmanModel->fetchAll("SELECT * FROM salesman");
		return $salesmen;
	}
}
