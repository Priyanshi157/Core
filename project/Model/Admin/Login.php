<?php Ccc::loadClass('Model_Core_Login'); ?>
<?php 
class Model_Admin_login extends Model_Core_Login
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getSession()
	{
		if(!$this->session)
		{
			$this->setSession(Ccc::getModel('Admin_Session'));
		}
		return $this->session;
	}
}