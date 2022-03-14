<?php Ccc::loadClass('Model_Core_View');

class Controller_Core_Action 
{
	protected $layout = null;
	protected $message = null;

	public function redirect($a=null,$c=null,array $data = [],$reset = false)
    {
        $url = Ccc::getModel('core_view')->getUrl($a,$c,$data,$reset);
        header("location: $url");
    }

    protected function setTitle($title)
    {
        $this->getLayout()->getHead()->setTitle($title);
    }

	public function getmessage()
	{
		if (!$this->message) 
		{
			$this->setmessage(Ccc::getModel('Admin_Message'));
		}
		return $this->message;
	}

	public function setmessage($message)
	{
		$this->message = $message;
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

	public function setLayout($layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function renderLayout()
	{
		$this->getResponse()->setHeader('Content-type', 'text/html')->render($this->getLayout()->toHtml());
	}

	public function getRequest()
	{
		return Ccc::getFront()->getRequest();
	}

	public function getResponse()
    {
        return Ccc::getFront()->getResponse();
    }
}