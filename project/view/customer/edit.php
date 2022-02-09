<?php
require_once("Model/Core/Adapter.php");
$adapter = new Model_Core_Adapter();
try 
{
	$cid = $_GET['id'];
	if(!$cid)
	{
		throw new Exception("Invalid Request.", 1);
	}
	$customer = $adapter->fetchRow("SELECT * FROM customer WHERE customerId = '$cid'");
	if(count($customer) > 0)
	{
		$customerid = $customer['customerId'];
		$firstName = $customer['firstName'];
		$lastName = $customer['lastName'];
		$email = $customer['email'];
		$mobile = $customer['mobile'];
		$status = $customer['status'];
		$customerAddress = $adapter->fetchRow("SELECT * FROM address WHERE customerId = $customerid");
		if(count($customerAddress) > 0)
		{
			$address = $customerAddress['address'];
			$postalCode = $customerAddress['postalCode'];
			$city = $customerAddress['city'];
			$state = $customerAddress['state'];
			$country = $customerAddress['country'];
			$billing = $customerAddress['billing'];
			$shiping = $customerAddress['shiping'];
		}
	}
	
} 
catch (Exception $e) 
{
	throw new Exception("System is unable to fetch.", 1);
}
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
	<form method="POST" action="index.php?c=customer&a=save&id=<?php echo $cid ?>">

	  <div class="row mb-4">
	    <div class="col-md-10">
	      <input type="hidden" class="form-control" id="customerid" name="customer[customerId]" value="<?php echo $cid;?>">
	    </div>
	  </div>


	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">First Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="firstName" name="customer[firstName]" value="<?php echo $firstName; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="name" class="col-sm-2 col-form-label">Last Name</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="lastName" name="customer[lastName]" value="<?php echo $lastName; ?>">
	    </div>
	  </div>

	  <div class="row mb-4">
	    <label for="price" class="col-sm-2 col-form-label">email</label>
	    <div class="col-md-10">
	      <input type="email" class="form-control" id="email" name="customer[email]" value="<?php echo $email?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="qty" class="col-sm-2 col-form-label">mobile</label>
	    <div class="col-md-10">
	      <input type="text" class="form-control" id="mobile" name="customer[mobile]" value="<?php echo $mobile?>">
	    </div>
	  </div>

	  <div class="row mb-3">
	    <label for="created" class="col-sm-2 col-form-label">Status</label>
	    <div class="row col-sm-10">
		    <div class="form-check col-sm-6">
		    	<?php if($status == 1){ ?>
			  	<input class="form-check-input col-sm-4" type="radio" name="customer[status]" id="flexRadioDefault1" value="1" checked>
			  	<?php }else{ ?>
			  	<input class="form-check-input col-sm-4" type="radio" name="customer[status]" id="flexRadioDefault1" value="1">
			  	<?php } ?>
			  <label class="form-check-label col-sm-2" for="flexRadioDefault1">
			    Active
			  </label>		
			</div>
			<div class="form-check col-sm-6">
				<?php if($status == 2){ ?>
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
		    	<input type="text" class="form-control" id="address" name="customerAddress[address]" value="<?php echo $address?>">
	    	</div>
	  	</div>

		<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">Postal Code</label>
	    	<div class="col-md-10">
	    		<input type="text" class="form-control" id="postalCode" name="customerAddress[postalCode]" value="<?php echo $postalCode?>">
	    	</div>
	  	</div>

	  	<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">City</label>
	    	<div class="col-md-10">
	      		<input type="text" class="form-control" id="city" name="customerAddress[city]" value="<?php echo $city?>">
	    	</div>
	  	</div>

	  	<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">State</label>
	    	<div class="col-md-10">
	      		<input type="text" class="form-control" id="state" name="customerAddress[state]" value="<?php echo $state?>">
	    	</div>
	  	</div>

	  	<div class="row mb-3">
	    	<label for="qty" class="col-sm-2 col-form-label">Country</label>
	    	<div class="col-md-10">
	      		<input type="text" class="form-control" id="country" name="customerAddress[country]" value="<?php echo $country?>">
	    	</div>
	  	</div>

	  	<div class="row mb-4">
		    <input type="checkbox" id="billing" name="customerAddress[billing]" value="1" <?php if ($billing == 1) { echo "checked"; } ?>>
			<label for="vehicle1">Billing</label><br>
			<input type="checkbox" id="shiping" name="customerAddress[shiping]" value="1" <?php if ($shiping == 1) { echo "checked"; } ?>>
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