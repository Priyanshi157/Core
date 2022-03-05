<?php
$products = $this->getProducts();
?>
<a href="<?php echo $this->getUrl('add','product',[],true); ?>"><button type="button" class="btn btn-primary">Add</button></a>
<table class="table border my-4">
  <thead>
    <tr>
      <th scope="col">Product Id</th>
      <th scope="col">Name</th>
      <th scope="col">Base Image</th>
      <th scope="col">Thumb Image</th>
      <th scope="col">Small Image</th>
      <th scope="col">Price</th>
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
				<td><img src="<?php echo "Media/Product/".$this->getMedia($product->base)['name']  ?>" alt="No Image Found" width="50" height="50"></td>
				<?php else: ?>
				<td>No Base Image</td>
				<?php endif; ?>	
				<?php if($product->thumb): ?>
				<td><img src="<?php echo "Media/Product/".$this->getMedia($product->thumb)['name']  ?>" alt="No Image Found" width="50" height="50"></td>
				<?php else: ?>
				<td>No Thumb Image</td>
				<?php endif; ?>	
				<?php if($product->small): ?>
				<td><img src="<?php echo "Media/Product/".$this->getMedia($product->small)['name']  ?>" alt="No Image Found" width="50" height="50"></td>
				<?php else: ?>
				<td>No Small Image</td>
				<?php endif; ?>
			    <td><?php echo $product->price ?></td>
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
