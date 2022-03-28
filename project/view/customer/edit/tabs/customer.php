<?php $customer = $this->getCustomer(); ?>

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

<div class="row justify-content-center">
		<button type="submit" class="btn btn-primary col-sm-2 m-1">Save</button>
		<a href="<?php echo $this->getUrl('grid','customer',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
</div>
