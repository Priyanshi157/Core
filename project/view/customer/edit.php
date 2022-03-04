<?php

$customer = $this->getCustomer();
$customerAddress = $this->getAddress();

?>
<form method="POST" action="<?php echo $this->getUrl('save','customer',['id'=>$customer->customerId],true); ?>">
  <div class="row mb-4">
    <div class="col-md-10">
      <input type="hidden" class="form-control" id="customerid" name="customer[customerId]" value="<?php echo $customer->customerId;?>">
    </div>
  </div>


  <div class="row mb-4">
    <label for="name" class="col-sm-2 col-form-label">First Name</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="firstName" name="customer[firstName]" value="<?php echo $customer->firstName; ?>">
    </div>
  </div>

  <div class="row mb-4">
    <label for="name" class="col-sm-2 col-form-label">Last Name</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="lastName" name="customer[lastName]" value="<?php echo $customer->lastName; ?>">
    </div>
  </div>

  <div class="row mb-4">
    <label for="price" class="col-sm-2 col-form-label">email</label>
    <div class="col-md-10">
      <input type="email" class="form-control" id="email" name="customer[email]" value="<?php echo $customer->email?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="qty" class="col-sm-2 col-form-label">mobile</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="mobile" name="customer[mobile]" value="<?php echo $customer->mobile ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="created" class="col-sm-2 col-form-label">Status</label>
    <div class="row col-sm-10">
	    <div class="form-check col-sm-6">
	    	<select name="customer[status]">
				<option value="1" <?php echo ($customer->getStatus($customer->status)=='Active')?'selected':'' ?>>Active</option>
				<option value="2" <?php echo ($customer->getStatus($customer->status)=='Inactive')?'selected':'' ?>>Inactive</option>
			</select>
		</div>
  	</div>

  	<div class="row mb-4">
    	<div class="col-md-10">
      		<input type="hidden" class="form-control" id="customerid" name="address[customerId]" value="<?php echo $customer->customerId;?>">
    	</div>
  	</div>

  	<input type="hidden" class="form-control" id="addressId" name="address[addressId]" value="<?php echo $customerAddress->addressId?>">

  	<div class="row mb-3">
	    <label for="qty" class="col-sm-2 col-form-label">Address</label>
	    <div class="col-md-10">
	    	<input type="text" class="form-control" id="address" name="address[address]" value="<?php echo $customerAddress->address?>">
    	</div>
  	</div>

	<div class="row mb-3">
    	<label for="qty" class="col-sm-2 col-form-label">Postal Code</label>
    	<div class="col-md-10">
    		<input type="text" class="form-control" id="postalCode" name="address[postalCode]" value="<?php echo $customerAddress->postalCode?>">
    	</div>
  	</div>

  	<div class="row mb-3">
    	<label for="qty" class="col-sm-2 col-form-label">City</label>
    	<div class="col-md-10">
      		<input type="text" class="form-control" id="city" name="address[city]" value="<?php echo $customerAddress->city?>">
    	</div>
  	</div>

  	<div class="row mb-3">
    	<label for="qty" class="col-sm-2 col-form-label">State</label>
    	<div class="col-md-10">
      		<input type="text" class="form-control" id="state" name="address[state]" value="<?php echo $customerAddress->state?>">
    	</div>
  	</div>

  	<div class="row mb-3">
    	<label for="qty" class="col-sm-2 col-form-label">Country</label>
    	<div class="col-md-10">
      		<input type="text" class="form-control" id="country" name="address[country]" value="<?php echo $customerAddress->country?>">
    	</div>
  	</div>

	<div class="row mb-4">
		<input type="checkbox" name="address[billing]" value="1" <?php echo ($customerAddress->getStatus($customerAddress->billing)=='Active')?'checked':'' ?>>
			
		<label for="billing"> Billing</label><br>

		<input type="checkbox" name="address[shiping]" value="1" <?php echo ($customerAddress->getStatus($customerAddress->shiping)=='Active')?'checked':'' ?>>
		
		<label for="shiping"> Shiping</label><br>
	</div>

  	<div class="row justify-content-center">
  		<button type="submit" class="btn btn-primary col-sm-2 m-1">Update</button>
  		<a href="<?php echo $this->getUrl('grid','customer',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
	</div>
</form>
