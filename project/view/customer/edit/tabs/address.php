<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shipingAddress = $this->getShipingAddress(); ?>


<!-- Horizontal Form -->
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Billing Address</h3>
  </div>

  <input type="hidden" name="billingAddress[billing]" value="1">
  <input type="hidden" name="billingAddress[shiping]" value="2">

  <div class="card-body">
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="billingaddress" name="billingAddress[address]" value="<?php echo $billingAddress->address?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Postal Code</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="billingpostalcode" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">City</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="billingcity" name="billingAddress[city]" value="<?php echo $billingAddress->city?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">State</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="billingstate" name="billingAddress[state]" value="<?php echo $billingAddress->state?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Country</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="billingcountry" name="billingAddress[country]" value="<?php echo $billingAddress->country?>">
      </div>
    </div>
  </div>

  <div class="card-header">
    <h3 class="card-title">Shiping Address</h3>
  </div>

  <div class="card-body">
    <div class="form-group row">
      <label for="Address" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10">
           <div class="form-check">
              <input type="checkbox" class="form-check-input" name="sameBill" id="sameBill" onclick="same()">
              <label for="copyAddress" class="form-check-label">Same as Billing Address</label>
          </div>
      </div>
    </div>

    
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="shipingaddress" name="shipingAddress[address]" value="<?php echo $shipingAddress->address?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Postal Code</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="shipingpostalcode" name="shipingAddress[postalCode]" value="<?php echo $shipingAddress->postalCode?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">City</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="shipingcity" name="shipingAddress[city]" value="<?php echo $shipingAddress->city?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">State</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="shipingstate" name="shipingAddress[state]" value="<?php echo $shipingAddress->state?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Country</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="shipingcountry" name="shipingAddress[country]" value="<?php echo $shipingAddress->country?>">
      </div>
    </div>

    <div class="card-footer">
      <button type="button" name="submit" class="btn btn-primary w-25" id="addressSubmitBtn">Save</button>
      <button type="button" class="btn btn-primary w-25 float-right" id="cancel">Cancel</a></button>
    </div>

  </div>
</div>
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


<script>
$("#addressSubmitBtn").click(function(){
    admin.setForm($("#indexForm"));
    admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
    admin.load();
});

$("#cancel").click(function(){
    admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
    admin.load();
});
</script>