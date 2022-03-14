<?php
$salesmen = $this->getSalesmen();
?>
<a href="<?php echo $this->getUrl('add','salesman',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>

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
