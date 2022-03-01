<?php 
Ccc::loadClass('Model_Core_View');

class Controller_Core_Action 
{
	protected $view = null;
	protected $layout = null;

	public function redirect($url)
	{
		header("Location: $url");
		exit();
	}

	public function getview()
	{
		if (!$this->view) 
		{
			$this->setview(new Model_Core_View());
		}
		return $this->view;
	}

	public function setview($view)
	{
		$this->view = $view;
		return $this;
	}

	public function getLayout()
	{
		if (!$this->layout) 
		{
			$this->setlayout(Ccc::getBlock('Core_Layout'));
		}
		return $this->layout;
	}

	public function setlayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function renderLayout()
	{
		$this->getLayout()->toHtml();
	}

	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}
}