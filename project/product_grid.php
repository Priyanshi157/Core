<?php
global $adapter;
$products = $adapter->fetchAll("SELECT * FROM product");
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Products CRUD</title>
</head>
<body>
	<div class="fluid-container m-2">
		<a href="product.php?a=addAction"><button type="button" class="btn btn-primary">Add</button></a>
		<table class="table border my-4">
		  <thead>
		    <tr>
		      <th scope="col">Product Id</th>
		      <th scope="col">Name</th>
		      <th scope="col">Price</th>
		      <th scope="col">Quantity</th>
		      <th scope="col">Status</th>
		      <th scope="col">Created At</th>
		      <th scope="col">Updated AT</th>
		      <th scope="col">Edit</th>
		      <th scope="col">Delete</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if(!$products): ?>
		  		<tr><td colspan="10">No Record available.</td></tr>
		  	<?php else: ?>
		  		<?php foreach ($products as $product): ?>
			  		<tr>
					    <td><?php echo $product['productId'] ?></td>
					    <td><?php echo $product['name'] ?></td>
					    <td><?php echo $product['price'] ?></td>
					    <td><?php echo $product['quantity'] ?></td>
					    <td><?php echo $product['status'] ?></td>
					    <td><?php echo $product['createdAt'] ?></td>
					    <td><?php echo $product['updatedAt'] ?></td>
					    <td><a href="product.php?a=editAction&id=<?php echo $product['productId'] ?>">Edit</a></td>
						<td><a href="product.php?a=deleteAction&id=<?php echo $product['productId'] ?>">Delete</a></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		  </tbody>
		</table>
	</div>

	</body>
</html>