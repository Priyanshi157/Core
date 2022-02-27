<?php
$admins = $this->getAdmins();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Admin</title>
</head>
<body>
	<div class="fluid-container m-2">
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
	</div>

	</body>
</html>