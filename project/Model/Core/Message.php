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
			$this->setSession(Ccc::getModel('Core_Session'));
		}
		return $this->session;
	}

	public function setSession($session)
	{
		$this->session = $session;
		return $this;
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