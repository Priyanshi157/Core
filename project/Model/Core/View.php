<?php
class Model_Core_View
{
	public $template = null;
	public $data = [];

	public function getTemplate()
	{
		return $this->template;
	}

	public function setTemplate($template)
	{
		$this->template = $template;
		return $this;
	}

	public function toHtml()
    {
        ob_start();
        require($this->getTemplate());
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

	public function getData($key = null)
	{
		if(!$key)
		{
			return $this->data;
		}
		if (array_key_exists($key, $this->data)) 
		{
			return $this->data[$key];
		}
		return null;
	}

	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}

	public function __get($key = null)
    {
        if(array_key_exists($key,$this->data))
        {
            return $this->data[$key];
        }
        return null;
    }

	public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

	public function __unset($key)
    {
        if(array_key_exists($key,$this->data))
        {
            unset($this->data[$key]);
        }
        return $this;
    }

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}

	public function getUrl($a=null,$c=null,array $data = [],$reset = false)
	{
		$info = [];
		if($a==null && $c==null && $data==null && $reset==false)
		{
			$info = Ccc::getFront()->getRequest()->getRequest();
		}
		
		if($a == null)
		{
			$info['a'] = Ccc::getFront()->getRequest()->getRequest('a');
		}
		else
		{
			$info['a'] = $a;
		}
		
		if($c == null)
		{
			$info['c'] = Ccc::getFront()->getRequest()->getRequest('c');
		}
		else
		{
			$info['c'] = $c;
		}
		
		if($reset)
		{
			if($data) 
			{
				$info = array_merge($info,$data);
			}
		}
		else
		{
			$info = array_merge(Ccc::getFront()->getRequest()->getRequest(),$info);
			if($data) 
			{
				$info = array_merge($info,$data);
			}	
		}
		$url = "index.php?".http_build_query($info);
		return $url;
	}

	public function getBaseUrl($subUrl = null)
    {
        $url = getcwd();
        if($subUrl)
        {
            $url = $url."/".$subUrl;
        }
        return $url;
    }
}

