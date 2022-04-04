<?php $admin = $this->getAdmin(); ?>

<!-- Horizontal Form -->
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Admin Information</h3>
  </div>
  
    <div class="card-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-10">
          <input type="hidden" class="form-control" id="adminId" name="admin[adminId]" value="<?php echo $admin->adminId; ?>">
          <input type="text" class="form-control" id="firstName" name="admin[firstName]" value="<?php echo $admin->firstName; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="lastName" name="admin[lastName]" value="<?php echo $admin->lastName; ?>">
        </div>
      </div>

      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" name="admin[email]" value="<?php echo $admin->email;?>">
        </div>
      </div>

      <?php if(!$admin->password): ?>
      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="password" name="admin[password]" value="<?php echo $admin->password;?>">
        </div>
      </div>
      <?php endif; ?>

      
      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
          <select name="admin[status]" class="form-control">
            <option value="1" <?php echo ($admin->getStatus($admin->status)=='Active')?'selected':'' ?>>Active</option>
            <option value="2" <?php echo ($admin->getStatus($admin->status)=='Inactive')?'selected':'' ?>>Inactive</option>
          </select>
        </div>
      </div>
    
    <div class="card-footer">
      <button type="button" name="submit" class="btn btn-primary w-25" id="adminSubmitBtn">Save</button>
      <button type="button" class="btn btn-primary w-25 float-right" id="cancel">Cancel</a></button>
    </div>
</div>


<script>
$("#adminSubmitBtn").click(function(){
    admin.setForm($("#indexForm"));
    admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
    admin.load();
});

$("#cancel").click(function(){
    admin.setUrl("<?php echo $this->getUrl('gridBlock','admin'); ?>");
    admin.load();
});
</script>
