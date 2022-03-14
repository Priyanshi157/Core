<?php
$vendors = $this->getVendors();
$addresses = $this->getAddresses();
?>
<a href="<?php echo $this->getUrl('add','vendor',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>

<div>
<script type="text/javascript">
function ppr() 
{
	const pprValue = document.getElementById('ppr').selectedOptions[0].value;
	let url = window.location.href;
	if(!url.includes('ppr'))
	{
		url += '&ppr=20';
	}

	const myArray = url.split("&");
	for(i = 0 ; i < myArray.length ; i++)
	{
		if(myArray[i].includes('p='))
		{
			myArray[i] = 'p=1';
		}

		if(myArray[i].includes('ppr='))
		{
			myArray[i] = 'ppr='+pprValue;
		}
	}
	const str = myArray.join("&");
	location.replace(str);
}
</script>
<select onchange="ppr()" id="ppr">
	<option>Select</option>
	<?php foreach($this->getPager()->getPerPageCountOption() as $perPageCount) :?>	
		<option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></option>
	<?php endforeach;?>
</select>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart()]); ?>" style="<?php echo ($this->getPager()->getStart() == NULL) ? "pointer-events: none;" : "" ?> ">Start</a></button>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getPrev()]); ?>" style="<?php echo ($this->getPager()->getPrev() == NULL) ? "pointer-events: none;" : "" ?>">Prev</a></button>

<button>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->getPager()->getCurrent(); ?> &nbsp;&nbsp;&nbsp;&nbsp;</button>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getNext()]); ?>" style="<?php echo ($this->getPager()->getNext() == NULL) ? "pointer-events: none;" : "" ?>">Next</a></button>

<button><a href="<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getEnd()]); ?>" style="<?php echo ($this->getPager()->getEnd() == NULL) ? "pointer-events: none;" : "" ?> ">End</a></button>
</div>

<table class="table table-bordered my-4">
  <thead>
    <tr>
      <th>Vendor Id</th>
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
			    <td><?php echo $vendor->getStatus($vendor->status) ?></td>
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
