<?php $config = $this->getConfig(); ?>

<!-- Horizontal Form -->
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Config Information</h3>
  </div>
  
    <div class="card-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="hidden" class="form-control" id="configId" name="config[configId]" value="<?php echo $config->configId; ?>">
          <input type="text" class="form-control" id="name" name="config[name]" value="<?php echo $config->name; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Code</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="code" name="config[code]" value="<?php echo $config->code; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Value</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="value" name="config[value]" value="<?php echo $config->value;?>">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
          <select name="config[status]">
						<option value="1" <?php echo ($config->getStatus($config->status)=='Active')?'selected':'' ?> selected>Active</option>
						<option value="2" <?php echo ($config->getStatus($config->status)=='Inactive')?'selected':'' ?>>Inactive</option>
				  </select>
        </div>
      </div>
    
    <div class="card-footer">
      <button type="button" name="submit" class="btn btn-primary w-25" id="configSubmitBtn">Save</button>
      <button type="button" class="btn btn-primary w-25 float-right" id="cancel">Cancel</a></button>
    </div>
</div>

<script>
$("#configSubmitBtn").click(function(){
    admin.setForm($("#indexForm"));
    admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
    admin.load();
});

$("#cancel").click(function(){
    admin.setUrl("<?php echo $this->getUrl('gridBlock','config'); ?>");
    admin.load();
});
</script>
