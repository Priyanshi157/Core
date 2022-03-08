<?php
$salesmen = $this->getSalesmen();
?>
<a href="<?php echo $this->getUrl('add','salesman',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>
<table class="table table-bordered my-4">
  <thead>
    <tr>
      <th>Salesman Id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>Status</th>
      <th>Created At</th>
      <th>Updated AT</th>
      <th>Edit</th>
      <th>Delete</th>
      <th>Customer</th>
      <th>Percentage</th>
    </tr>
  </thead>
  <tbody>
  	<?php if(!$salesmen): ?>
  		<tr><td colspan="10">No Record available.</td></tr>
  	<?php else: ?>
  		<?php foreach ($salesmen as $salesman): ?>
	  		<tr>
			    <td><?php echo $salesman->salesmanId ?></td>
			    <td><?php echo $salesman->firstName ?></td>
			    <td><?php echo $salesman->lastName ?></td>
			    <td><?php echo $salesman->email ?></td>
			    <td><?php echo $salesman->mobile ?></td>
			    <td><?php echo $salesman->getStatus($salesman->status) ?></td>
			    <td><?php echo $salesman->createdAt ?></td>
			    <td><?php echo $salesman->updatedAt ?></td>
			    <td><a href="<?php echo $this->getUrl('edit','salesman',['id'=>$salesman->salesmanId],true); ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','salesman',['id'=>$salesman->salesmanId],true); ?>">Delete</a></td>
				<td><a href="<?php echo $this->getUrl('grid','salesman_salesmancustomer',['id' => $salesman->salesmanId],true); ?>">Customer</a></td>
        <td><?php echo $salesman->discount; ?></td>                      
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
  </tbody>
</table>
