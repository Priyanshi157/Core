<?php 
class Model_Core_Message
{
	const MESSAGE_SUCCESS = 1;
	const MESSAGE_WARNING = 2;
	const MESSAGE_ERROR = 3;
	const MESSAGE_DEFAULT = 1;
	const MESSAGE_SUCCESS_LBL = 'success';
	const MESSAGE_WARNING_LBL = 'warning';
	const MESSAGE_ERROR_LBL = 'error';

	protected $session = null;
	protected $sessionClassName = null;

	public function __construct()
	{
		
	}

	public function getSessionClassName()
	{
		return $this->sessionClassName;
	}

	public function setSessionClassName($sessionClassName)
	{
		$this->sessionClassName = $sessionClassName;
		return $this;
	}

	public function addMessage($message,$type = null)
	{
		$types = [
			self::MESSAGE_SUCCESS => self::MESSAGE_SUCCESS_LBL,
			self::MESSAGE_WARNING => self::MESSAGE_WARNING_LBL,
			self::MESSAGE_ERROR => self::MESSAGE_ERROR_LBL,
			self::MESSAGE_DEFAULT => self::MESSAGE_SUCCESS_LBL
		];

		if(!array_key_exists($type, $types))
		{
			$type = self::MESSAGE_DEFAULT;
		}
		$type = $types[$type];
		$messages[$type] = $message;
		$this->getSession()->messages = $messages;
		return $this;
	}

	public function getSession()
	{
		if(!$this->session)
		{
			$this->setSession();
		}
		return $this->session;
	}

	public function setSession($session = null)
	{
		if(!$session)
		{
			$session = 'Core_Session';
		}
		$this->session = Ccc::getModel($session);
		return $this->session;
	}

	public function getMessages()
	{
		$this->getSession()->start();
		if(!$this->getSession()->messages)
		{
            return null;
        }
        return $this->getSession()->messages;
	}

	public function unsetMessages()
	{
		$this->getSession()->start();
		if(!$this->getSession()->messages)
		{
            return null;
        }
		unset($this->getSession()->messages);
		return $this;
	}
}