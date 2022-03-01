<?php
$vendors = $this->getVendors();
$addresses = $this->getAddresses();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Vendor</title>
</head>
<body>
	
	<div class="fluid-container m-2">
		<a href="<?php echo $this->getUrl('add','vendor',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>
		<table class="table table-bordered my-4">
		  <thead>
		    <tr>
		      <th scope="col">Vendor Id</th>
		      <th scope="col">First Name</th>
		      <th scope="col">Last Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Mobile</th>
		      <th scope="col">Status</th>
		      <th scope="col">Created At</th>
		      <th scope="col">Updated AT</th>
		      <th scope="col">Address</th>
		      <th scope="col">Edit</th>
		      <th scope="col">Delete</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(!$vendors): ?>
		  		<tr><td colspan="10">No Record available.</td></tr>
		  	<?php else: ?>
		  		<?php foreach ($vendors as $vendor): ?>
			  		<tr>
					    <td><?php echo $vendor->vendorId ?></td>
					    <td><?php echo $vendor->firstName ?></td>
					    <td><?php echo $vendor->lastName ?></td>
					    <td><?php echo $vendor->email ?></td>
					    <td><?php echo $vendor->mobile ?></td>
					    <td><?php echo $vendor->status ?></td>
					    <td><?php echo $vendor->createdAt ?></td>
					    <td><?php echo $vendor->updatedAt ?></td>
					    <?php if(!$addresses): ?>
					    	<td>No Address Found.</td>
					    <?php else: ?>
						    <?php foreach ($addresses as $address): ?>
						    	<?php if($address->vendorId == $vendor->vendorId): ?>
						    		<td><?php echo $address->address ?></td>
						    	<?php endif; ?>
						    <?php endforeach; ?>
						<?php endif; ?>
						<td><a href="<?php echo $this->getUrl('edit','vendor',['id'=>$vendor->vendorId],true); ?>">Edit</a></td>
						<td><a href="<?php echo $this->getUrl('delete','vendor',['id'=>$vendor->vendorId],true); ?>">Delete</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		  </tbody>
		</table>
	</div>

</body>
</html>