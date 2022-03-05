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
		require($this->getTemplate());
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

	public function addData($key,$value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key)
	{
		if(array_key_exists($key,$this->value))
		{
			unset($this->data[$key]);
		}
		return $this;
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
			$a = Ccc::getFront()->getRequest()->getRequest('a');
		}
		else
		{
			$info['a']=$a;
		}
		
		if($c == null)
		{
			$c = Ccc::getFront()->getRequest()->getRequest('c');
		}
		else
		{
			$info['c']=$c;
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
        $url = "C:/xampp/htdocs/core-session/Core/project";
        if($subUrl)
        {
            $url = $url."/".$subUrl;
        }
        return $url;
    }
}

?>