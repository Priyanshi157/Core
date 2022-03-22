 <form action="<?php echo $this->getUrl('loginPost','admin_login') ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td width="10%">Email:</td>
			<td><input type="text" name="admin[email]"></td>
		</tr>
		<tr>
			<td width="10%">Password:</td>
			<td><input type="password" name="admin[password]"></td>
		</tr>
		<tr>
			<td width="10%">  </td>
			<td><input type="submit"></td>
		</tr>
	</table>
</form>

<!-- 
<form action="<?php //echo $this->getUrl('loginPost','admin_login') ?>" method="POST" class="form-center">
  <div class="form-outline">
    <label for="exampleInputEmail1" class="col-form-label">Email </label><br>
    <input type="email" class="form-label" aria-describedby="emailHelp" name="admin[name]">
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="col-form-label">Password</label><br>
    <input type="password" class="form-label" name="admin[password]">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form> -->