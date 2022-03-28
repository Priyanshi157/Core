<?php Ccc::loadClass('Block_Core_Template');

class Block_Page_Edit_Tabs_Personal extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate('view/page/edit/tabs/personal.php');
    }

    public function getPage()
    {
        return Ccc::getRegistry('page');
    }
}