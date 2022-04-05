<?php $vendorAddress = $this->getAddress(); ?>

<!-- Horizontal Form -->
<div class="card card-info">
  <div class="card-body">
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="address" name="address[address]" value="<?php echo $vendorAddress->address?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Postal Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="postalCode" name="address[postalCode]" value="<?php echo $vendorAddress->postalCode?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">City</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="city" name="address[city]" value="<?php echo $vendorAddress->city?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">State</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="state" name="address[state]" value="<?php echo $vendorAddress->state?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Country</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="country" name="address[country]" value="<?php echo $vendorAddress->country?>">
      </div>
    </div>
  </div>

  <div class="card-footer">
    <button type="button" name="submit" class="btn btn-primary w-25" id="addressSubmitBtn">Save</button>
    <button type="button" class="btn btn-primary w-25 float-right" id="cancel">Cancel</a></button>
  </div>

  </div>
</div>
</div>


<script>
$("#addressSubmitBtn").click(function(){
    admin.setForm($("#indexForm"));
    admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
    admin.load();
});

$("#cancel").click(function(){
    admin.setUrl("<?php echo $this->getUrl('gridBlock','vendor'); ?>");
    admin.load();
});
</script>