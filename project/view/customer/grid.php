<?php $customers = $this->getCustomers(); ?>
<?php $addresses = $this->getAddresses(); ?>

<a href="<?php echo $this->getUrl('add','customer',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>

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
