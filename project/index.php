<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title></title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-white">
	    <div class="container-fluid">
	      	<button
		        class="navbar-toggler"
		        type="button"
		        data-mdb-toggle="collapse"
		        data-mdb-target="#navbarExample01"
		        aria-controls="navbarExample01"
		        aria-expanded="false"
		        aria-label="Toggle navigation"
		    >
	        <i class="fas fa-bars"></i>
	      	</button>
	      	<div class="collapse navbar-collapse" id="navbarExample01">
	        	<ul class="navbar-nav me-auto mb-2 mb-lg-0">
	          		<li class="nav-item active">
	            		<a class="nav-link" aria-current="page" href="index.php?c=Admin&a=grid">Admin</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="index.php?c=category&a=grid">Category</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="index.php?c=product&a=grid">Product</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="index.php?c=customer&a=grid">Customer</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="index.php?c=config&a=grid">Config</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="index.php?c=page&a=grid">Page</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="index.php?c=salesman&a=grid">Salesman</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="index.php?c=vendor&a=grid">Vendor</a>
	          		</li>
	        	</ul>
	      	</div>
	    </div>
	</nav>
</body>
</html>

<?php require_once('Model/Core/Adapter.php'); ?>
<?php $adapter = new Model_Core_Adapter; ?>
<?php 

class Ccc
{
	public static $front = null;

	public static function getFront()
	{
		if(!self::$front)
		{
			Ccc::loadClass('Controller_Core_Front');
			$front = new Controller_Core_Front();
			self::setFront($front);
		}
		return self::$front;
	}

	public static function setFront($front)
	{
		self::$front = $front;
	}

	public static function loadFile($path)
	{
		//require_once(getcwd().'/'.$path);
		require_once($path);
	}
	public static function loadClass($className)
	{
		$path = str_replace("_", "/", $className).'.php';
		Ccc::loadFile($path);
	}
	
	public static function init()
	{
		self::getFront()->init();
	}

	public static function getModel($className)
	{
		$className = 'Model_'.$className;
		self::loadClass($className);
		return (new $className());
	}

	public static function getBlock($className)
	{
		$className = 'Block_'.$className;
		self::loadClass($className);
		return (new $className());
	}
}

Ccc::init();
