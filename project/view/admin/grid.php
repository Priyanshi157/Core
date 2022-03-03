<?php $admins = $this->getAdmins(); ?>
<a href="<?php echo $this->getUrl('add','admin',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>
<table class="table border my-4">
  <thead>
    <tr>
      <th scope="col">Admin Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Status</th>
      <th scope="col">Created At</th>
      <th scope="col">Updated AT</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  	<?php if(!$admins): ?>
  		<tr><td colspan="10">No Record available.</td></tr>
  	<?php else: ?>
  		<?php foreach ($admins as $admin): ?>
	  		<tr>
			    <td><?php echo $admin->adminId ?></td>
			    <td><?php echo $admin->firstName ?></td>
			    <td><?php echo $admin->lastName ?></td>
			    <td><?php echo $admin->email ?></td>
			    <td><?php echo $admin->password ?></td>
			    <td><?php echo $admin->getStatus($admin->status) ?></td>
			    <td><?php echo $admin->createdAt ?></td>
			    <td><?php echo $admin->updatedAt ?></td>
			    <td><a href="<?php echo $this->getUrl('edit','admin',['id'=>$admin->adminId],true); ?>">Edit</a></td>
			    <td><a href="<?php echo $this->getUrl('delete','admin',['id'=>$admin->adminId],true); ?>">Delete</a></td>
			    
				
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
  </tbody>
</table>
