<?php
$customers = $this->getCustomers();
$addresses = $this->getAddresses();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Customer</title>
</head>
<body>
	
	<div class="fluid-container m-2">
		<a href="<?php echo $this->getUrl('add','customer',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>
		<table class="table table-bordered my-4">
		  <thead>
		    <tr>
		      <th scope="col">customer Id</th>
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
		  	<?php if(!$customers): ?>
		  		<tr><td colspan="10">No Record available.</td></tr>
		  	<?php else: ?>
		  		<?php foreach ($customers as $customer): ?>
			  		<tr>
					    <td><?php echo $customer->customerId ?></td>
					    <td><?php echo $customer->firstName ?></td>
					    <td><?php echo $customer->lastName ?></td>
					    <td><?php echo $customer->email ?></td>
					    <td><?php echo $customer->mobile ?></td>
					    <td><?php echo $customer->status ?></td>
					    <td><?php echo $customer->createdAt ?></td>
					    <td><?php echo $customer->updatedAt ?></td>
					    <?php foreach ($addresses as $address): ?>
					    	<?php if($address->customerId == $customer->customerId): ?>
					    		<td><?php echo $address->address ?></td>
					    	<?php endif; ?>
					    <?php endforeach; ?>
						<td><a href="<?php echo $this->getUrl('edit','customer',['id'=>$customer->customerId],true); ?>">Edit</a></td>
						<td><a href="<?php echo $this->getUrl('delete','customer',['id'=>$customer->customerId],true); ?>">Delete</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		  </tbody>
		</table>
	</div>

</body>
</html>