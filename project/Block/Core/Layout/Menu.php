<?php  Ccc::loadClass('Block_Core_Template');
class Block_Core_Layout_Menu extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/core/layout/menu.php');
	}

	public function getLoginStatus()
    {
        $loginModel = Ccc::getModel('Admin_Login');
        if($loginModel->isLogedIn())
        {
            return true; 
        }
        return false;
    }
}
