<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php 
class Controller_Admin_Login extends Controller_Admin_Action
{
	public function loginAction()
	{
		$content = $this->getLayout()->getContent();
		$loginGrid = Ccc::getBlock('Admin_Login_Grid');
		$content->addChild($loginGrid,'Grid');
		$this->renderLayout();
	}

	public function loginPostAction()
	{
		try 
		{
			$this->setTitle('Admin_Login');
			$adminModel = Ccc::getModel('Admin');
			$loginModel = Ccc::getModel('Admin_Login');
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("Invalid request.", 1);
			}

			if (!$request->getPost()) 
			{
				throw new Exception("Invalid request.", 1);
			}

			$loginData = $request->getPost('admin');
			$password = md5($loginData['password']);
			$adminData = $adminModel->fetchAll("SELECT * FROM `admin` WHERE `email`= '{$loginData['email']}' AND `password` = '{$password}' ");
			if(!$adminData)
			{
				$this->getMessage()->addMessage("Login details are Incorrect!");
				throw new Exception("Invalid request.", 1);
			}

			$loginModel->login($adminData[0]->email);
			$this->getMessage()->addMessage("Login Successful.");
			$this->redirect('grid','product',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('login','admin_login',[],true);
		}
	}

	public function logoutAction()
	{
		$loginModel = Ccc::getModel('Admin_Login');
		if($loginModel->isLogedIn())
		{
			$loginModel->logout();
		}
		$this->redirect('login','admin_login');
	}
}