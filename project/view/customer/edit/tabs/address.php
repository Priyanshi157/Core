<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shipingAddress = $this->getShipingAddress(); ?>

  <div class="row mb-4">
    <label for="name" class="col-sm-2 col-form-label">Billing Address</label>
  </div>

  <input type="hidden" name="billingAddress[billing]" value="1">
  <input type="hidden" name="billingAddress[shiping]" value="2">

	<div class="row mb-3">
    <label for="qty" class="col-sm-2 col-form-label">Address</label>
    <div class="col-md-10">
    	<input type="text" class="form-control" id="billingaddress" name="billingAddress[address]" value="<?php echo $billingAddress->address?>">
  	</div>
	</div>

  <div class="row mb-3">
  	<label for="qty" class="col-sm-2 col-form-label">Postal Code</label>
  	<div class="col-md-10">
  		<input type="number" class="form-control" id="billingpostalcode" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode?>">
  	</div>
	</div>

	<div class="row mb-3">
  	<label for="qty" class="col-sm-2 col-form-label">City</label>
  	<div class="col-md-10">
    		<input type="text" class="form-control" id="billingcity" name="billingAddress[city]" value="<?php echo $billingAddress->city?>">
  	</div>
	</div>

	<div class="row mb-3">
  	<label for="qty" class="col-sm-2 col-form-label">State</label>
  	<div class="col-md-10">
    		<input type="text" class="form-control" id="billingstate" name="billingAddress[state]" value="<?php echo $billingAddress->state?>">
  	</div>
	</div>

	<div class="row mb-3">
  	<label for="qty" class="col-sm-2 col-form-label">Country</label>
  	<div class="col-md-10">
    		<input type="text" class="form-control" id="billingcountry" name="billingAddress[country]" value="<?php echo $billingAddress->country?>">
  	</div>
	</div>

<div class="row mb-4">
  <label for="name" class="col-sm-2 col-form-label">Shiping Address</label>
</div>

<div>
  <input type="checkBox" name="sameBill" id="sameBill" onclick="same()">
  <label for="name">Same as Billing Address</label>
</div> 

<input type="hidden" name="shipingAddress[shiping]" value="1">
<input type="hidden" name="shipingAddress[billing]" value="2">

<div class="row mb-3">
    <label for="qty" class="col-sm-2 col-form-label">Address</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="shipingaddress" name="shipingAddress[address]" value="<?php echo $shipingAddress->address?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="qty" class="col-sm-2 col-form-label">Postal Code</label>
    <div class="col-md-10">
      <input type="number" class="form-control" id="shipingpostalcode" name="shipingAddress[postalCode]" value="<?php echo $shipingAddress->postalCode?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="qty" class="col-sm-2 col-form-label">City</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="shipingcity" name="shipingAddress[city]" value="<?php echo $shipingAddress->city?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="qty" class="col-sm-2 col-form-label">State</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="shipingstate" name="shipingAddress[state]" value="<?php echo $shipingAddress->state?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="qty" class="col-sm-2 col-form-label">Country</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="shipingcountry" name="shipingAddress[country]" value="<?php echo $shipingAddress->country?>">
    </div>
  </div>

	<div class="row justify-content-center">
		<button type="submit" class="btn btn-primary col-sm-2 m-1">Save</button>
		<a href="<?php echo $this->getUrl('grid','customer',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
</div>


<script type="text/javascript">
function same() 
{
  var checkBox = document.getElementById("sameBill");
  if(checkBox.checked == true)
  {
    document.getElementById("shipingaddress").value = document.getElementById("billingaddress").value; 
    document.getElementById("shipingpostalcode").value = document.getElementById("billingpostalcode").value; 
    document.getElementById("shipingcity").value = document.getElementById("billingcity").value; 
    document.getElementById("shipingstate").value = document.getElementById("billingstate").value; 
    document.getElementById("shipingcountry").value = document.getElementById("billingcountry").value; 
  }
  else
  {
    document.getElementById("shipingaddress").value = null; 
    document.getElementById("shipingpostalcode").value = null; 
    document.getElementById("shipingcity").value = null; 
    document.getElementById("shipingstate").value = null; 
    document.getElementById("shipingcountry").value = null; 
  }
}
</script>
