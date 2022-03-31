<?php $config = $this->getConfig(); ?>

<input type="hidden" class="form-control" id="configId" name="config[configId]" value="<?php echo $config->configId; ?>">

<div class="row mb-4">
<label for="name" class="col-sm-2 col-form-label">Name</label>
<div class="col-md-10">
  <input type="text" class="form-control" id="name" name="config[name]" value="<?php echo $config->name; ?>">
</div>
</div>

<div class="row mb-4">
<label for="price" class="col-sm-2 col-form-label">Code</label>
<div class="col-md-10">
  <input type="text" class="form-control" id="code" name="config[code]" value="<?php echo $config->code; ?>">
</div>
</div>

<div class="row mb-3">
<label for="qty" class="col-sm-2 col-form-label">Value</label>
<div class="col-md-10">
  <input type="text" class="form-control" id="value" name="config[value]" value="<?php echo $config->value;?>">
</div>
</div>

<div class="row mb-3">
<label for="created" class="col-sm-2 col-form-label">Status</label>
<div class="row col-sm-10">
    <div class="form-check col-sm-6">
	  	<select name="config[status]">
			<option value="1" <?php echo ($config->getStatus($config->status)=='Active')?'selected':'' ?> selected>Active</option>
			<option value="2" <?php echo ($config->getStatus($config->status)=='Inactive')?'selected':'' ?>>Inactive</option>
		  </select>

	</div>
</div>

<div class="row justify-content-center">
<button type="button" class="btn btn-primary col-sm-2 m-1" id="submit">Save</button>
<a class="btn btn-primary  col-sm-2 m-1" id="cancel">Cancel</a>
</div>
