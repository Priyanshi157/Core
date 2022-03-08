<?php
$customers = $this->getCustomers();
$addresses = $this->getAddresses();
?>
<a href="<?php echo $this->getUrl('add','customer',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>
<table class="table table-bordered my-4">
  <thead>
    <tr>
      <th>customer Id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>Status</th>
      <th>Created At</th>
      <th>Updated AT</th>
      <th>Address</th>
      <th>Edit</th>
      <th>Delete</th>
      <th>Price</th>
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
			    <td><?php echo $customer->getStatus($customer->status) ?></td>
			    <td><?php echo $customer->createdAt ?></td>
			    <td><?php echo $customer->updatedAt ?></td>
			    <?php foreach ($addresses as $address): ?>
			    	<?php if($address->customerId == $customer->customerId): ?>
			    		<td><?php echo $address->address ?></td>
			    	<?php endif; ?>
			    <?php endforeach; ?>
				<td><a href="<?php echo $this->getUrl('edit','customer',['id'=>$customer->customerId],true); ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','customer',['id'=>$customer->customerId],true); ?>">Delete</a></td>
				<td><a href="<?php echo $this->getUrl('grid','customer_price',['id' => $customer->customerId],true); ?>">Price</a></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
  </tbody>
</table>
