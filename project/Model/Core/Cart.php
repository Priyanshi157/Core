<?php 
class Model_Core_Cart
{
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

	public function addCart($cartId)
	{
        $this->getSession()->cart = $cartId;
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

	public function getCart()
	{
		$this->getSession()->start();
		if(!$this->getSession()->cart)
		{
            return null;
        }
        return $this->getSession()->cart;
	}

	public function unsetCart()
	{
		$this->getSession()->start();
		if(!$this->getSession()->cart)
		{
            return null;
        }
		unset($this->getSession()->cart);
		return $this;
	}
}