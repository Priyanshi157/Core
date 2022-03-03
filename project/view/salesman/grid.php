<?php
$salesmen = $this->getSalesmen();
?>
<a href="<?php echo $this->getUrl('add','salesman',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>
<table class="table table-bordered my-4">
  <thead>
    <tr>
      <th scope="col">Salesman Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Status</th>
      <th scope="col">Created At</th>
      <th scope="col">Updated AT</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
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
			    <td><?php echo $salesman->status ?></td>
			    <td><?php echo $salesman->createdAt ?></td>
			    <td><?php echo $salesman->updatedAt ?></td>
			    <td><a href="<?php echo $this->getUrl('edit','salesman',['id'=>$salesman->salesmanId],true); ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','salesman',['id'=>$salesman->salesmanId],true); ?>">Delete</a></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
  </tbody>
</table>
