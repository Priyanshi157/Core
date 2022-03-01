<?php

$vendor = $this->getVendor();
$vendorAddress = $this->getAddress();
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
	<div class="container">
	<form method="POST" action="<?php echo $this->getUrl('save','vendor',['id'=>$vendor->vendorId],true); ?>">

	  <div class="row mb-4">
	    <div class="col-md-10">
	      <input type="hidden" class="form-control" id="vendorid" name="vendor[vendorId]" value="<?php echo $vendor->vendorId;?>">
	    </div>
	  </div>


	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">First Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="firstName" name="vendor[firstName]" value="<?php echo $vendor->firstName; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">Last Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="lastName" name="vendor[lastName]" value="<?php echo $vendor->lastName; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="price" class="col-sm-2 col-form-label">email</label>
	    <div class="col-md-10">
	      <input type="email" class="form-control" id="email" name="vendor[email]" value="<?php echo $vendor->email?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="qty" class="col-sm-2 col-form-label">mobile</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="mobile" name="vendor[mobile]" value="<?php echo $vendor->mobile ?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="created" class="col-sm-2 col-form-label">Status</label>
	    <div class="row col-sm-10">
		    <div class="form-check col-sm-6">
		    	<select name="vendor[status]">
					<option value="1" <?php echo ($vendor->getStatus($vendor->status)=='Active')?'selected':'' ?>>Active</option>
					<option value="2" <?php echo ($vendor->getStatus($vendor->status)=='Inactive')?'selected':'' ?>>Inactive</option>
				</select>
			</div>
	  	</div>

	    <input type="hidden" class="form-control" id="vendorid" name="address[vendorId]" value="<?php echo $vendorAddress->vendorId;?>">

	  	<input type="hidden" class="form-control" id="addressId" name="address[addressId]" value="<?php echo $vendorAddress->addressId?>">

	  	<div class="row mb-3">
		    <label for="qty" class="col-sm-2 col-form-label">Address</label>
		    <div class="col-md-10">
		    	<input type="text" class="form-control" id="address" name="address[address]" value="<?php echo $vendorAddress->address?>">
	    	</div>
	  	</div>

		<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">Postal Code</label>
	    	<div class="col-md-10">
	    		<input type="text" class="form-control" id="postalCode" name="address[postalCode]" value="<?php echo $vendorAddress->postalCode?>">
	    	</div>
	  	</div>

	  	<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">City</label>
	    	<div class="col-md-10">
	      		<input type="text" class="form-control" id="city" name="address[city]" value="<?php echo $vendorAddress->city?>">
	    	</div>
	  	</div>

	  	<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">State</label>
	    	<div class="col-md-10">
	      		<input type="text" class="form-control" id="state" name="address[state]" value="<?php echo $vendorAddress->state?>">
	    	</div>
	  	</div>

	  	<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">Country</label>
	    	<div class="col-md-10">
	      		<input type="text" class="form-control" id="country" name="address[country]" value="<?php echo $vendorAddress->country?>">
	    	</div>
	  	</div>

	  	<div class="row justify-content-center">
	  		<button type="submit" class="btn btn-primary col-sm-2 m-1">Save</button>
	  		<a href="<?php echo $this->getUrl('grid','vendor',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
		</div>
	</form>
	</div>
</body>
</html>