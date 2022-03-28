<?php $admin = $this->getAdmin(); ?>
<div class="row mb-4">
  <div class="col-md-10">
    <input type="hidden" class="form-control" id="adminId" name="admin[adminId]" value="<?php echo $admin->adminId; ?>">
  </div>
</div>


<div class="row mb-4">
  <label for="name" class="col-sm-2 col-form-label">First Name</label>
  <div class="col-md-10">
    <input type="text" class="form-control" id="firstName" name="admin[firstName]" value="<?php echo $admin->firstName; ?>">
  </div>
</div>

<div class="row mb-4">
  <label for="price" class="col-sm-2 col-form-label">Last Name</label>
  <div class="col-md-10">
    <input type="text" class="form-control" id="lastName" name="admin[lastName]" value="<?php echo $admin->lastName; ?>">
  </div>
</div>

<div class="row mb-3">
  <label for="qty" class="col-sm-2 col-form-label">Email</label>
  <div class="col-md-10">
    <input type="email" class="form-control" id="email" name="admin[email]" value="<?php echo $admin->email;?>">
  </div>
</div>

<div class="row mb-3">
  <?php if(!$admin->password): ?>
  <label for="qty" class="col-sm-2 col-form-label">Password</label>
  <div class="col-md-10" >
    <input type="password" class="form-control" id="password" name="admin[password]" value="<?php echo $admin->password;?>">
  </div>
<?php endif; ?>
</div>

<div class="row mb-3">
  <label for="created" class="col-sm-2 col-form-label">Status</label>
  <div class="row col-sm-10">
    <div class="form-check col-sm-6">
	  	<select name="admin[status]">
			<option value="1" <?php echo ($admin->getStatus($admin->status)=='Active')?'selected':'' ?>>Active</option>
			<option value="2" <?php echo ($admin->getStatus($admin->status)=='Inactive')?'selected':'' ?>>Inactive</option>
		</select>
	</div>
</div>

<div class="row justify-content-center">
<button type="submit" class="btn btn-primary col-sm-2 m-1">Save</button>
<a href="<?php echo $this->getUrl('grid','admin',[],true); ?>" class="btn btn-primary  col-sm-2 m-1">Cancel</a>
</div>