<!DOCTYPE html>
<html>
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
	            		<a class="nav-link" aria-current="page" href="<?php echo $this->getUrl('grid','admin',['p'=>1],true) ?>">Admin</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','category',['p'=>1],true) ?>">Category</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','product',['p'=>1],true) ?>">Product</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','customer',['p'=>1],true) ?>">Customer</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','config',['p'=>1],true) ?>">Config</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','page',['p'=>1],true) ?>">Page</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','salesman',['p'=>1],true) ?>">Salesman</a>
	          		</li>
	          		<li class="nav-item">
	            		<a class="nav-link" href="<?php echo $this->getUrl('grid','vendor',['p'=>1],true) ?>">Vendor</a>
	          		</li>
	        	</ul>
	        	<a class="nav-link" href="<?php echo $this->getUrl('logout','admin_login') ?>">Logout</a>
	      	</div>
	    </div>
	</nav>
</body>
</html>
