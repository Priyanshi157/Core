<?php

$customerData = $this->getData('customer');
$customerAddress = $this->getData('address');

?>
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
	            		<a class="nav-link" aria-current="page" href="#">Admin</a>
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
	        	</ul>
	      	</div>
	    </div>
	</nav>

	<div class="container">
	<form method="POST" action="index.php?c=customer&a=save&id=<?php echo $customerData['customerId']; ?>">

	  <div class="row mb-4">
	    <div class="col-md-10">
	      <input type="hidden" class="form-control" id="customerid" name="customer[customerId]" value="<?php echo $customerData['customerId'];?>">
	    </div>
	  </div>


	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">First Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="firstName" name="customer[firstName]" value="<?php echo $customerData['firstName']; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">Last Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="lastName" name="customer[lastName]" value="<?php echo $customerData['lastName']; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="price" class="col-sm-2 col-form-label">email</label>
	    <div class="col-md-10">
	      <input type="email" class="form-control" id="email" name="customer[email]" value="<?php echo $customerData['email']?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="qty" class="col-sm-2 col-form-label">mobile</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="mobile" name="customer[mobile]" value="<?php echo $customerData['mobile'] ?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="created" class="col-sm-2 col-form-label">Status</label>
	    <div class="row col-sm-10">
		    <div class="form-check col-sm-6">
		    	<?php if($customerData['status'] == 1){ ?>
			  	<input class="form-check-input col-sm-4" type="radio" name="customer[status]" id="flexRadioDefault1" value="1" checked>
			  	<?php }else{ ?>
			  	<input class="form-check-input col-sm-4" type="radio" name="customer[status]" id="flexRadioDefault1" value="1">
			  	<?php } ?>
			  <label class="form-check-label col-sm-2" for="flexRadioDefault1">
			    Active
			  </label>		
			</div>
			<div class="form-check col-sm-6">
				<?php if($customerData['status'] == 2){ ?>
			 <input class="form-check-input col-sm-4" type="radio" name="customer[status]" id="flexRadioDefault2"  value="2" checked>
			  	<?php }else{ ?>
			  <input class="form-check-input col-sm-4" type="radio" name="customer[status]" id="flexRadioDefault2"  value="2" >
			  	<?php } ?>
			 
			  <label class="form-check-label col-sm-2" for="flexRadioDefault2">
			    InActive
			  </label>
			</div>
	  	</div>

	  	<div class="row mb-3">
		    <label for="qty" class="col-sm-2 col-form-label">Address</label>
		    <div class="col-md-10">
		    	<input type="text" class="form-control" id="address" name="address[address]" value="<?php echo $customerAddress['address']?>">
	    	</div>
	  	</div>

		<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">Postal Code</label>
	    	<div class="col-md-10">
	    		<input type="text" class="form-control" id="postalCode" name="address[postalCode]" value="<?php echo $customerAddress['postalCode']?>">
	    	</div>
	  	</div>

	  	<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">City</label>
	    	<div class="col-md-10">
	      		<input type="text" class="form-control" id="city" name="address[city]" value="<?php echo $customerAddress['city']?>">
	    	</div>
	  	</div>

	  	<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">State</label>
	    	<div class="col-md-10">
	      		<input type="text" class="form-control" id="state" name="address[state]" value="<?php echo $customerAddress['state']?>">
	    	</div>
	  	</div>

	  	<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">Country</label>
	    	<div class="col-md-10">
	      		<input type="text" class="form-control" id="country" name="address[country]" value="<?php echo $customerAddress['country']?>">
	    	</div>
	  	</div>

	  	<div class="row mb-4">
		    <input type="checkbox" id="billing" name="address[billing]" value="1" <?php if ($customerAddress['billing'] == 1) { echo "checked"; } ?>>
			<label for="vehicle1">Billing</label><br>
			<input type="checkbox" id="shiping" name="address[shiping]" value="1" <?php if ($customerAddress['shiping'] == 1) { echo "checked"; } ?>>
			<label for="vehicle2"> Shipping </label><br>
		</div>

	  	<div class="row justify-content-center">
	  		<button type="submit" class="btn btn-primary col-sm-2 m-1">Update</button>
	  		<a href="index.php?c=customer&a=grid" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
		</div>
	</form>
	</div>
</body>
</html>