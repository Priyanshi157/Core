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
	            		<a class="nav-link" aria-current="page" href="<?php echo $this->getUrl('grid','admin',[],true) ?>">Admin</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','category',[],true) ?>">Category</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','product',[],true) ?>">Product</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','customer',[],true) ?>">Customer</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','config',[],true) ?>">Config</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','page',[],true) ?>">Page</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','salesman',[],true) ?>">Salesman</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','vendor',[],true) ?>">Vendor</a>
	          		</li>
	        	</ul>
	        	<a class="nav-link" href="<?php echo $this->getUrl('loginPost','admin_login') ?>">Logout</a>
	      	</div>
	    </div>
	</nav>
</body>
</html>
