<?php $salesman = $this->getsalesman(); ?>

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Salesman Information</h3>
  </div>
  
    <div class="card-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-10">
          <input type="hidden" class="form-control" id="salesmanId" name="salesman[salesmanId]" value="<?php echo $salesman->salesmanId;?>">
          <input type="text" class="form-control" id="firstName" name="salesman[firstName]" value="<?php echo $salesman->firstName; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="lastName" name="salesman[lastName]" value="<?php echo $salesman->lastName; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" name="salesman[email]" value="<?php echo $salesman->email?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Mobile</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="mobile" name="salesman[mobile]" value="<?php echo $salesman->mobile ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Discount</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="discount" name="salesman[discount]" value="<?php echo $salesman->discount ?>">
        </div>
      </div>

      
      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
          <select name="salesman[status]">
            <option value="1" <?php echo ($salesman->getStatus($salesman->status)=='Active')?'selected':'' ?>>Active</option>
            <option value="2" <?php echo ($salesman->getStatus($salesman->status)=='Inactive')?'selected':'' ?>>Inactive</option>
          </select>
        </div>
      </div>
    
    <div class="card-footer">
      <button type="button" name="submit" class="btn btn-primary w-25" id="salesmanSubmitBtn">Save</button>
      <button type="button" class="btn btn-primary w-25 float-right" id="cancel">Cancel</a></button>
    </div>
</div>

<script>
$("#salesmanSubmitBtn").click(function(){
    admin.setForm($("#indexForm"));
    admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
    admin.load();
});

$("#cancel").click(function(){
    admin.setUrl("<?php echo $this->getUrl('gridBlock','salesman'); ?>");
    admin.load();
});
</script>