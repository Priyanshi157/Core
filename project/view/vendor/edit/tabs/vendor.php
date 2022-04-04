<?php $vendor = $this->getVendor(); ?>

<!-- Horizontal Form -->
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Vendor Information</h3>
  </div>
  
    <div class="card-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-10">
          <input type="hidden" class="form-control" id="vendorid" name="vendor[vendorId]" value="<?php echo $vendor->vendorId;?>">
          <input type="text" class="form-control" id="firstName" name="vendor[firstName]" value="<?php echo $vendor->firstName; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="lastName" name="vendor[lastName]" value="<?php echo $vendor->lastName; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" name="vendor[email]" value="<?php echo $vendor->email?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Mobile</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="mobile" name="vendor[mobile]" value="<?php echo $vendor->mobile ?>">
        </div>
      </div>

      
      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
          <select name="vendor[status]">
          <option value="1" <?php echo ($vendor->getStatus($vendor->status)=='Active')?'selected':'' ?>>Active</option>
          <option value="2" <?php echo ($vendor->getStatus($vendor->status)=='Inactive')?'selected':'' ?>>Inactive</option>
        </select>
        </div>
      </div>
    
    <div class="card-footer">
      <button type="button" name="submit" class="btn btn-primary w-25" id="vendorSubmitBtn">Save</button>
      <button type="button" class="btn btn-primary w-25 float-right" id="cancel">Cancel</a></button>
    </div>
</div>

<script>
$("#vendorSubmitBtn").click(function(){
    admin.setForm($("#indexForm"));
    admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
    admin.load();
});

$("#cancel").click(function(){
    admin.setUrl("<?php echo $this->getUrl('gridBlock','vendor'); ?>");
    admin.load();
});
</script>