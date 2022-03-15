<?php
$products = $this->getProducts();
?>
<a href="<?php echo $this->getUrl('add','product',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>

<div>
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

<table class="table border my-4">
  <thead>
    <tr>
      <th scope="col">Product Id</th>
      <th scope="col">Name</th>
      <th scope="col">Base Image</th>
      <th scope="col">Thumb Image</th>
      <th scope="col">Small Image</th>
      <th scope="col">Price</th>
      <th scope="col">MSP</th>
      <th scope="col">Cost Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Status</th>
      <th scope="col">Created At</th>
      <th scope="col">Updated AT</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      <th scope="col">Gallery</th>
    </tr>
  </thead>
  <tbody>
  	<?php if(!$products): ?>
  		<tr><td colspan="10">No Record available.</td></tr>
  	<?php else: ?>
  		<?php foreach ($products as $product): ?>
	  		<tr>
			    <td><?php echo $product->productId ?></td>
			    <td><?php echo $product->name ?></td>
			    <?php if($product->base): ?>
				<td><img src="<?php echo "Media/Product/".$product->getBase()->name  ?>" alt="No Image Found" width="50" height="50"></td>
				<?php else: ?>
				<td>No Base Image</td>
				<?php endif; ?>	
				<?php if($product->thumb): ?>
				<td><img src="<?php echo "Media/Product/".$product->getThumb()->name  ?>" alt="No Image Found" width="50" height="50"></td>
				<?php else: ?>
				<td>No Thumb Image</td>
				<?php endif; ?>	
				<?php if($product->small): ?>
				<td><img src="<?php echo "Media/Product/".$product->getSmall()->name  ?>" alt="No Image Found" width="50" height="50"></td>
				<?php else: ?>
				<td>No Small Image</td>
				<?php endif; ?>
			    <td><?php echo $product->price ?></td>
			    <td><?php echo $product->msp ?></td>
			    <td><?php echo $product->costPrice ?></td>
			    <td><?php echo $product->quantity ?></td>
			    <td><?php echo $product->getStatus($product->status) ?></td>
			    <td><?php echo $product->createdAt ?></td>
			    <td><?php echo $product->updatedAt ?></td>
			    <td><a href="<?php echo $this->getUrl('edit','product',['id'=>$product->productId],true); ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','product',['id'=>$product->productId],true); ?>">Delete</a></td>
				<td><a href="<?php echo $this->getUrl('grid','product_media',['id'=>$product->productId],true); ?>">Gallery</a></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
  </tbody>
</table>
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
